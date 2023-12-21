<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\PendingUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\GeneratedPasswordEmail;
use App\Mail\RegistrationStatusMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function approveUsers($id)
{
    // Check if $id is available
    if (!$id) {
        return redirect()->back()->with('error', 'Invalid ID provided.');
    }

    $pendingUser = PendingUser::find($id);

    // Check if a pending user with the given ID was found
    if (!$pendingUser) {
        return redirect()->back()->with('error', 'Pending user not found.');
    }

    // Generate a random temporary password
    $temporaryPassword = Str::random(12);

    // Create user in 'users' table with the temporary password
    $user = User::create([
        'name' => $pendingUser->name,
        'email' => $pendingUser->email,
        'student_number' =>$pendingUser->student_number,
        'course' => $pendingUser->course,
        'age' => $pendingUser->age,
        'birthday' => $pendingUser->birthday,
        'password' => bcrypt($temporaryPassword),
    ]);

    // Send generated password email to the user
    Mail::to($user->email)->send(new GeneratedPasswordEmail($user, $temporaryPassword));

    // Optionally, you can delete the pending user record
    $pendingUser->delete();
    $pendingUsers = PendingUser::all();
    
    return redirect()->route('admindashboard')->with(['pendingUsers' => $pendingUsers, 'success' => 'User approved successfully.']);

}


    public function declineUser($id)
    {
        $pendingUser = PendingUser::find($id);

        // Send decline email to the user
        $this->sendStatusEmail($pendingUser, 'declined');

        // Delete the pending user record
        $pendingUser->delete();
        $pendingUsers = PendingUser::all();
        return view('admindashboard', compact('pendingUsers'))->with('success', 'User declined successfully.');
    }

    private function sendStatusEmail($user, $status)
    {
        // Send email to the user with the registration status
        Mail::to($user->email)->send(new RegistrationStatusMail($user, $status));
    }

}
