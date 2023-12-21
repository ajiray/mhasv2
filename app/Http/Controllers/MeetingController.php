<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Notifications\MeetingCodeNotification;

class MeetingController extends Controller
{

    public function createMeeting(Request $request) {

        
        $METERED_DOMAIN = env('METERED_DOMAIN');
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');

        // Contain the logic to create a new meeting
        $response = Http::post("https://{$METERED_DOMAIN}/api/v1/room?secretKey={$METERED_SECRET_KEY}", [
            'enableComposition' => true,
            'recordComposition' => true,
        ]);
        $roomName = $response->json("roomName");
        
         // Get the user_id from the request
    $user_id = $request->input('user_id');

    // Dispatch the notification
    $user = User::find($user_id);
    $user->notify(new MeetingCodeNotification($roomName));
    return redirect("/meeting/{$roomName}"); // We will update this soon.
    }
    public function leftmeeting(){
        return view('dashboard');
    }
    public function validateMeeting(Request $request) {
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');
        $METERED_DOMAIN = env('METERED_DOMAIN');
        $meetingId = $request->input('meetingId');

        // Contains logic to validate existing meeting
        $response = Http::get("https://{$METERED_DOMAIN}/api/v1/room/{$meetingId}?secretKey={$METERED_SECRET_KEY}");

        $roomName = $response->json("roomName");


        if ($response->status() === 200)  {
            return redirect("/meeting/{$roomName}"); // We will update this soon
        } else {
            return redirect()->back()->with('error', 'Invalid code. Please contact the counselor for assistance.');
        }
    }
    public function getRecordings() {
        $METERED_DOMAIN = env('METERED_DOMAIN');  // Replace with your app name
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');
    
        $response = Http::get("https://{$METERED_DOMAIN}/api/v1/recordings?secretKey={$METERED_SECRET_KEY}");
    
        if ($response->successful()) {
            $recordings = $response->json();
            return view('screenrecordings', ['recordings' => $recordings]);
        } else {
            return response()->json(['error' => 'Failed to fetch recordings'], $response->status());
        }
    }
    public function showrecordings() {
        return view('screenrecordings');
    }
}
