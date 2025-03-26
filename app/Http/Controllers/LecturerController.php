<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $lecID = session('lecID'); // Get the logged-in lecturer ID

        if (!$lecID) {
            return redirect('/login')->withErrors(['error' => 'Please login first.']);
        }

        $lecturer = Lecturer::where('lecID', $lecID)->first(); // Fetch only the logged-in lecturer

        return view('lecturers', compact('lecturer')); // Pass only one lecturer
    }

    public function myCourses()
    {
        $lecID = session('lecID'); // Get the logged-in lecturer's ID

        if (!$lecID) {
            return redirect('/login')->withErrors(['error' => 'Please login first.']);
        }

        $courses = Course::where('lecID', $lecID)->get(); // Get courses assigned to the lecturer

        return view('courses', compact('courses')); // Updated view name
    }

    public function resetPassword(Request $request)
    {
        $lecID = session('lecID');
    
        if (!$lecID) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please log in again.']);
        }
    
        $lecturer = Lecturer::where('lecID', $lecID)->first();
    
        if (!$lecturer) {
            return response()->json(['success' => false, 'message' => 'Lecturer not found.']);
        }
    
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }
    
        if (!Hash::check($request->current_password, $lecturer->password)) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect.']);
        }
    
        $lecturer->password = Hash::make($request->new_password);
        $lecturer->save();
    
        return response()->json(['success' => true, 'message' => 'Your password has been successfully updated.']);
    }

    
}