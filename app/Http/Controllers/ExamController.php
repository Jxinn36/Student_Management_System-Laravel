<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Exam;
use App\Models\Course;

class ExamController extends Controller
{
    public function index()
    {
        $lecID = session('lecID'); // Get the lecturer's ID from session

        if (!$lecID) {
            return redirect()->route('login')->with('error', 'You need to login first!');
        }

        // Get courses assigned to the lecturer
        $courses = Course::where('lecID', $lecID)->with('students')->get();

        // Extract students from the lecturer's courses
        $students = collect();
        foreach ($courses as $course) {
            $students = $students->merge($course->students);
        }

        if ($students->isEmpty()) {
            return back()->with('error', 'No students found for your courses.');
        }

        // Group students by programme and group
        $groupedStudents = $students->groupBy(['programme', 'group']);



        return view('exam', compact('groupedStudents'));
    }

    public function showStudents($programme, $group)
    {
        $lecID = session('lecID'); // Get lecturer's ID from session

        if (!$lecID) {
            return redirect()->route('login')->with('error', 'You need to login first!');
        }

        // Get students under the lecturer's courses, filtered by programme & group
        $students = Student::where('programme', urldecode($programme))
            ->where('group', urldecode($group))
            ->get();

        return view('exam_students', compact('students', 'programme', 'group'));
    }

    //view enroll
    public function showStudentCourses($studID)
    {
        $student = Student::with('courses')->where('studID', $studID)->firstOrFail();

        // Fetch courses with marks and grades
        $courses = $student->courses->map(function ($course) use ($student) {
            $examRecord = Exam::where('studID', $student->studID)
                ->where('courseID', $course->courseID)
                ->first();

            $course->marks = $examRecord->marks ?? '-';
            $course->grade = $examRecord->grade ?? '-';

            return $course;
        });

        return view('exam_courses', compact('student', 'courses'));
    }

    public function updateMarks(Request $request, $studID, $courseID)
    {
        $request->validate([
            'marks' => 'required|numeric|min:0|max:100',
        ]);

        $marks = $request->input('marks');
        $grade = $this->getGradeFromMarks($marks);

        // Update or insert the student's marks in the exam table
        Exam::updateOrCreate(
            ['studID' => $studID, 'courseID' => $courseID],
            ['marks' => $marks, 'grade' => $grade]
        );

        // Update course average marks (avgSub)
        $averageCourse = Exam::where('courseID', $courseID)
            ->whereNotNull('marks')
            ->avg('marks'); // Directly using avg()

        Exam::where('courseID', $courseID)->update(['avgSub' => $averageCourse ?? 0]);

        // Update student's overall average marks (avgStud)
        $studentAverage = Exam::where('studID', $studID)
            ->whereNotNull('marks')
            ->avg('marks'); // Directly using avg()

        Exam::where('studID', $studID)->update(['avgStud' => $studentAverage ?? 0]);

        return back()->with('success', 'Marks updated successfully!');
    }

    public function updateAvgMarks(Request $request, $studID)
    {
        $request->validate([
            'avgStud' => 'required|numeric|min:0|max:100',
        ]);

        Exam::where('studID', $studID)->update(['avgStud' => $request->avgStud]);

        return response()->json(['message' => 'Average Marks Updated Successfully!']);
    }

    private function getGradeFromMarks($marks)
    {
        if ($marks >= 80)
            return 'A';
        if ($marks >= 75)
            return 'A-';
        if ($marks >= 70)
            return 'B+';
        if ($marks >= 65)
            return 'B';
        if ($marks >= 60)
            return 'B-';
        if ($marks >= 55)
            return 'C+';
        if ($marks >= 50)
            return 'C';
        return 'F';  // If marks are below 50
    }

    //report
    public function showReport($courseID)
    {
        $course = Course::where('courseID', $courseID)->firstOrFail();

        // Fetch students enrolled in this course with their average marks
        $students = Student::whereHas('exam', function ($query) use ($courseID) {
            $query->where('courseID', $courseID);
        })->with([
                    'exam' => function ($query) use ($courseID) {
                        $query->where('courseID', $courseID);
                    }
                ])->get();

        // Calculate the average marks for each student
        $students->each(function ($student) {
            $student->average_marks = $student->exam->avg('marks') ?? 0;
        });

        // Calculate the average marks for this subject
        $averageSubjectMarks = Exam::where('courseID', $courseID)->avg('marks') ?? 0;

        return view('exam_report', compact('course', 'students', 'averageSubjectMarks'));
    }

    public function exportCSV()
    {
        $data = DB::table('exam')
            ->join('students', 'exam.studID', '=', 'students.studID')
            ->join('courses', 'exam.courseID', '=', 'courses.courseID')
            ->select(
                'students.studID',
                'students.name',
                'students.email',
                'students.faculty',
                'students.programme',
                'students.year',
                'students.sem',
                'students.group',
                'courses.courseID',
                'courses.courseName',
                'exam.marks',
                'exam.grade',
                'exam.avgStud',
                'exam.avgSub'
            )
            ->get();

        $fileName = 'student_course_marks.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($data) {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, ['Student ID', 'Student Name', 'Student Email', 'Faculty', 'Programme', 'Year', 'Semester', 'Group', 'Course ID', 'Course Name', 'Marks', 'Grade', 'AvgStud', 'AvgSub']);

            // Add rows
            foreach ($data as $row) {
                fputcsv($handle, [
                    $row->studID,
                    $row->name,
                    $row->email,
                    $row->faculty,
                    $row->programme,
                    $row->year,
                    $row->sem,
                    $row->group,
                    $row->courseID,
                    $row->courseName,
                    $row->marks,
                    $row->grade,
                    $row->avgStud,
                    $row->avgSub
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }


}
