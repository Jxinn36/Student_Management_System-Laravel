<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        //  dd(session()->all());  
        if (!session()->has('lecID') || !session()->get('is_logged_in')) {
            return redirect()->route('login')->with('error', 'You need to login first!');
        }

        $lecID = session('lecID');

        // Fetch courses assigned to the logged-in lecturer
        $courses = Course::where('lecID', $lecID)->get();

        return view('courses', compact('courses'));
    }
    public function viewStudents($courseID)
    {
        $course = Course::where('courseID', $courseID)->first();

        if (!$course) {
            return redirect()->back()->withErrors(['error' => 'Course not found.']);
        }

        // Fetch students enrolled in this course
        $students = $course->students;

        return view('course_students', compact('course', 'students'));
    }

    // Show enrollment form with students who are NOT yet enrolled in the course
    public function showEnrollForm($courseID)
    {
        $course = Course::findOrFail($courseID);

        // Get students who are NOT enrolled in this course
        $students = Student::whereNotIn('studID', function ($query) use ($courseID) {
            $query->select('studID')->from('course_student')->where('courseID', $courseID);
        })->get();

        return view('enroll_student', compact('course', 'students'));
    }

    // Enroll a student in the course
    public function enrollStudent(Request $request, $courseID)
    {
        $request->validate([
            'studID' => 'required|exists:students,studID'
        ]);

        // Insert into pivot table course_student
        DB::table('course_student')->insert([
            'courseID' => $courseID,
            'studID' => $request->studID
        ]);

        return redirect()->route('course.students', ['courseID' => $courseID])
            ->with('success', 'Student successfully enrolled!');
    }

    public function dropStudent($courseID, $studID)
    {
        // Delete the student from course_student table
        $deleted = DB::table('course_student')
            ->where('courseID', $courseID)
            ->where('studID', $studID)
            ->delete();

        return response()->json(['success' => $deleted]);
    }

}