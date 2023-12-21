<?php

// app/Http/Controllers/ChangePasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

         // Check if the new password contains at least one uppercase letter, one lowercase letter, and one number
    if (!preg_match('/[A-Z]/', $request->new_password) || // Uppercase letter
    !preg_match('/[a-z]/', $request->new_password) || // Lowercase letter
    !preg_match('/[0-9]/', $request->new_password)     // Number
) {
    return redirect()->back()->withErrors(['new_password' => 'Password must have at least one uppercase letter, one lowercase letter, and one number.']);
}
        // Get the authenticated user
        $user = Auth::user();

        // Change the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Update the 'first_login' flag
        $user->update([
            'first_login' => false,
        ]);

        // Redirect the user to the dashboard or wherever you want
        return redirect('/dashboard')->with('success', 'Password changed successfully!');
    }
}

