<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Lecturer;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'lecID' => 'required',
            'password' => 'required'
        ]);

        // Check if lecturer exists
        $lecturer = Lecturer::where('lecID', $request->lecID)->first();

        if ($lecturer && Hash::check($request->password, $lecturer->password)) {
            // Store lecturer details in session
            session()->put('lecID', $lecturer->lecID);
            session()->put('is_logged_in', true);

            return redirect()->route('profile');
        }

        return back()->withErrors(['login_error' => 'Invalid Lecturer ID or Password']);
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // Clears all session data
        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password'); // Ensure this view exists
    }

    // Handle Forgot Password Request
    public function handleForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $lecturer = Lecturer::where('lecEmail', $request->email)->first();

        if (!$lecturer) {
            return back()->withErrors(['email' => 'Invalid Email.']);
        }

        // Store email in session to pass it to the next step
        Session::put('reset_email', $request->email);

        return redirect()->route('reset.password.form');
    }

    // Show Reset Password Form
    public function showResetPasswordForm()
    {
        $email = Session::get('reset_email');

        if (!$email) {
            return redirect()->route('forgot.password.form')->withErrors(['email' => 'Session expired. Try again.']);
        }

        return view('auth.reset-password', compact('email'));
    }

    // Handle Reset Password
    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = Session::get('reset_email');

        if (!$email) {
            return redirect()->route('forgot.password.form')->withErrors(['email' => 'Session expired. Try again.']);
        }

        $lecturer = Lecturer::where('lecEmail', $email)->first();
        $lecturer->password = bcrypt($request->password);
        $lecturer->save();

        // Clear session after successful password reset
        Session::forget('reset_email');

        return redirect()->route('login')->with('success', 'Password reset successfully. You can now login.');
    }

}