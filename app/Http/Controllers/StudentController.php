<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $studID = session('studID'); 

        if (!$studID) {
            return redirect('/login')->withErrors(['error' => 'Please login first.']);
        }

        $student = Student::where('studID', $studID)->first(); // Fetch only the logged-in student

        return view('students', compact('student')); // Pass only one student
    }

}
