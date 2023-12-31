<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\MeetingCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{

    public function createMeeting(Request $request)
    {
        $secretKey = env('METERED_SECRET_KEY');
        $apiEndpoint = "https://mindescape.metered.live/api/v1/room";

        // Get the user_id from the request
        $user_id = $request->input('user_id');

        // Fetch the user and the associated student_number using a join
        $userData = DB::table('accepted_appointments')
            ->join('users', 'accepted_appointments.user_id', '=', 'users.id')
            ->where('accepted_appointments.user_id', $user_id)
            ->select('users.student_number')
            ->first();

        $userrecording = DB::table('appointments')
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->where('appointments.user_id', $user_id)
            ->select('appointments.recording')
            ->first();

        $userStudentNumber = $userData->student_number;
        $userrecords = $userrecording->recording;

        $enableComposition = false;
        $recordComposition = false;

        // Check if a room with the same student number already exists
        $existingRoom = Http::get("https://mindescape.metered.live/api/v1/room/{$userStudentNumber}?secretKey={$secretKey}");

        if ($existingRoom->successful()) {
            // Room already exists, update settings based on userrecords
            if ($userrecords === 'Record') {
                $enableComposition = true;
                $recordComposition = true;

                // Make the API call to update the room
                $secretKey = 'sgiFd7esGmXEN0v5oOmtUz6VXABZrX6MEDLSeGuy5Q4FAIwa';
                $apiEndpoint = "https://mindescape.metered.live/api/v1/room/{$userStudentNumber}?secretKey={$secretKey}";

                // Make the API call to update the room
                $response = Http::put($apiEndpoint, [
                    'enableComposition' => true,
                    'recordComposition' => true,
                    // Add other fields as needed
                ]);

                // Check if the update was successful
                if ($response->successful()) {
                    // Room updated successfully
                    // You may want to add additional handling here if needed
                    return redirect("/meeting/{$userStudentNumber}");
                }
            } else {
                $secretKey = 'sgiFd7esGmXEN0v5oOmtUz6VXABZrX6MEDLSeGuy5Q4FAIwa';
                $apiEndpoint = "https://mindescape.metered.live/api/v1/room/{$userStudentNumber}?secretKey={$secretKey}";

                // Make the API call to update the room
                $response = Http::put($apiEndpoint, [
                    'enableComposition' => false,
                    'recordComposition' => false,
                    // Add other fields as needed
                ]);
                return redirect("/meeting/{$userStudentNumber}");
            }
        } else {
            // Room doesn't exist, create a new one based on userRecords
            // Combine student number and random code to create a unique room name
            $roomName = $userStudentNumber;

            if ($userrecords === 'Record') {
                // Make the API call to create a new meeting
                $response = Http::post("https://mindescape.metered.live/api/v1/room?secretKey={$secretKey}", [
                    'roomName' => $roomName,
                    'maxParticipants' => 3,
                    'enableComposition' => true,
                    'recordComposition' => true,
                    // Add other fields as needed
                ]);
            } else {
                // Make the API call to create a new meeting without recording
                $response = Http::post("https://mindescape.metered.live/api/v1/room?secretKey={$secretKey}", [
                    'roomName' => $roomName,
                    'maxParticipants' => 3,
                    'enableComposition' => false,
                    'recordComposition' => false,
                    // Add other fields as needed
                ]);
            }

            // Check if the creation was successful
            if ($response->successful()) {
                // Get the user_id from the request
                $user_id = $request->input('user_id');

                // Dispatch the notification
                $users = User::find($user_id);
                $users->notify(new MeetingCodeNotification($roomName));

                return redirect("/meeting/{$roomName}");
            }
        }

        // If the code reaches here, it means there was an error
        // Handle the error as needed
    }

    public function startRecording($roomName)
    {
        // Check if the user is an admin
        if (Auth::user()->is_admin) {
            // Enable recording in the session or database
            session(['recordComposition' => true, 'enableComposition' => true]);

            // Get the room name
            // Prepare the API endpoint URL
            $secretKey = 'sgiFd7esGmXEN0v5oOmtUz6VXABZrX6MEDLSeGuy5Q4FAIwa';
            $apiEndpoint = "https://mindescape.metered.live/api/v1/room/{$roomName}?secretKey={$secretKey}";

            // Make the API call to update the room
            $response = Http::put($apiEndpoint, [
                'enableComposition' => true,
                'recordComposition' => true,
                // Add other fields as needed
            ]);

            if ($response->successful()) {

                // Determine if a session refresh is needed
                $refreshSession = true; // You should implement your logic here

                return response()->json(['message' => 'Recording started successfully', 'refresh' => $refreshSession], 200);
            }

            // If the API call fails, return an error response
            return response()->json(['error' => 'Failed to update room'], $response->status());
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function leaveMeeting($roomName)
    {

        // Prepare the API endpoint URL
        $secretKey = 'sgiFd7esGmXEN0v5oOmtUz6VXABZrX6MEDLSeGuy5Q4FAIwa';
        $apiEndpoint = "https://mindescape.metered.live/api/v1/room/{$roomName}?secretKey={$secretKey}";

        // Make the API call to update the room
        $response = Http::put($apiEndpoint, [
            'enableComposition' => false,
            'recordComposition' => false,
            'enableRequestToJoin' => true,
            // Add other fields as needed
        ]);

        if ($response->successful()) {
            // Determine if a session refresh is needed
            $refreshSession = true; // You should implement your logic here

            return response()->json(['message' => 'Recording stopped successfully', 'refresh' => $refreshSession], 200);
        }

        // If the API call fails, return an error response
        return response()->json(['error' => 'Failed to update room'], $response->status());

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function validateMeeting(Request $request)
    {
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');
        $METERED_DOMAIN = env('METERED_DOMAIN');
        $meetingId = $request->input('meetingId');
        $userStudentNumber = Auth::user()->student_number;

        // Contains logic to validate existing meeting
        $response = Http::get("https://{$METERED_DOMAIN}/api/v1/room/{$meetingId}?secretKey={$METERED_SECRET_KEY}");

        $roomName = $response->json("roomName");

        if ($response->status() === 200) {
            // Set meetingId to roomName before redirecting
            $meetingId = $roomName;

            // Check if roomName matches the user's student_number
            if ($roomName !== $userStudentNumber) {
                return redirect()->back()->with('error', 'Invalid code. Please contact the counselor for assistance.');
            }

            return redirect("/meeting/{$meetingId}");
        } else {
            return redirect()->back()->with('error', 'Invalid code. Please contact the counselor for assistance.');
        }
    }

}
