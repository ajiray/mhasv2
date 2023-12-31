<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class CounselorController extends Controller
{
    public function index()
    {
        $counselors = User::whereIn('is_admin', [1, 2])->where('online', 1)->get();
        return view('dashboard', compact('counselors'));
    }
    
    public function updateOnlineStatus(Request $request, User $counselor)
    {
        $counselor->update(['online' => $request->input('online')]);
    
        return response()->json(['message' => 'Online status updated successfully']);
    }
    public function chatcounselor($user_id)
    {
        // Now you can use $user_id here
        // For example, you can retrieve the user with this ID
        $user = User::findOrFail($user_id);

        $chatifyUrl = "/chatify/{$user_id}";
        // ... (do whatever else you need with $user)

        // Return a response or view
        return redirect($chatifyUrl);
    }
}
