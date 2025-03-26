<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Student;
use App\Models\Lecturer;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;


Route::get('/', function () {
    return redirect()->route('login');
});

//login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', function () {
    return "Welcome to Dashboard!";
})->name('dashboard');

//forgot password
Route::post('/forgot-password', [AuthController::class, 'handleForgotPassword'])->name('forgot.password');
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot.password');


Route::post('/reset-password', [AuthController::class, 'handleResetPassword'])->name('reset.password');
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('reset.password.page');

//forgot password - verify email
Route::post('/verify-email', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $lecturer = Lecturer::where('lecEmail', $request->email)->first();

    if (!$lecturer) {
        return back()->withErrors(['email' => 'Email not found.']);
    }

    return redirect('/reset-password?email=' . $request->email);
});

//forgot password - reset
Route::post('/update-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    // Find the lecturer by email
    $lecturer = Lecturer::where('lecEmail', $request->email)->first();

    if (!$lecturer) {
        return back()->withErrors(['email' => 'Email not found.']);
    }

    // Update password in database
    $lecturer->update([
        'password' => Hash::make($request->password), // Securely hash the password
    ]);

    // Redirect back to login with success message
    return redirect('/login')->with('success', 'Password reset successful. Please log in.');
});

//profile
Route::get('/profile', [LecturerController::class, 'index'])->name('profile');
//reset password
Route::post('/reset-password', [LecturerController::class, 'resetPassword'])->name('reset.password');

//course
Route::get('/courses', [CourseController::class, 'index'])->name('courses');

//classes
Route::get('/classes', [LecturerController::class, 'myCourses'])->name('courses');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course/{courseID}/students', [CourseController::class, 'viewStudents'])->name('course.students');
//enroll student
Route::get('/course/{courseID}/enroll', [CourseController::class, 'showEnrollForm'])->name('course.enroll.form');
Route::post('/course/{courseID}/enroll', [CourseController::class, 'enrollStudent'])->name('course.enroll');
//drop student
Route::delete('/course/{courseID}/drop/{studID}', [CourseController::class, 'dropStudent'])->name('course.drop');


//exam
Route::get('/exam', [ExamController::class, 'index'])->name('exam');
Route::get('/exam/students', [ExamController::class, 'index'])->name('exam.students');
//view enroll
Route::get('/exam/student/{studID}/courses', [ExamController::class, 'showStudentCourses'])->name('exam.courses');
//update marks
Route::post('/update-average/{studID}', [ExamController::class, 'updateAvgMarks'])->name('updateAvgMarks');
Route::post('/exam/update-marks/{studID}/{courseID}', [ExamController::class, 'updateMarks'])->name('exam.updateMarks');
//exam page
Route::get('/exam/courses/{studID}', [ExamController::class, 'showStudentCourses'])->name('exam.courses');
Route::get('/exam/students/{programme}/{group}', [ExamController::class, 'showStudents'])->name('exam.students');
//report
Route::get('/export-csv', [ExamController::class, 'exportCSV'])->name('export.csv');


//logout
Route::get('/logout', function () {
    Session::flush(); // Clear all session data
    return redirect('/login'); // Redirect to login page
})->name('logout');


