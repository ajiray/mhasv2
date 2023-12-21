<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AcceptedAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentAcceptedMail;
use App\Mail\RescheduleNotification;
use App\Mail\StudentReschedMail;

class AppointmentController extends Controller
{
    public function bookAppointment(Request $request) {
        $incomingFields = $request->validate([
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'appointment_type' => 'required',
            'appointment_reason' => 'required'
        ]);
    
        $appointmentDateTime = Carbon::parse($incomingFields['appointment_date'] . ' ' . $incomingFields['appointment_time']);
        $currentDateTime = now();
    
        // Check if the appointment time is in the past or less than 30 minutes from now
        if ($appointmentDateTime <= $currentDateTime || $currentDateTime->diffInMinutes($appointmentDateTime) < 0) {
            return redirect()->back()->with('error', 'Please select an appointment time that is at least 30 minutes from now.');
        }
    
        
    
        $reason = $incomingFields['appointment_reason'];
        
        if ($reason === 'Other') {
            // If the selected reason is "Other," use the value from the 'other_reason' field
            $reason = $request->input('other_reason', '');
        }
    
        $appointmentData = [
            'date' => strip_tags($incomingFields['appointment_date']),
            'time' => strip_tags($incomingFields['appointment_time']),
            'type' => strip_tags($incomingFields['appointment_type']),
            'reason' => strip_tags($reason),
            'user_id' => auth()->id(),
        ];
    
        Appointment::create($appointmentData);
        return redirect('/appointment')->with('success', 'Success! Your appointment has been booked.');
    }
    
    
public function cancelAppointment(Appointment $appointment) {
    $appointment->delete();
    
    return redirect('/appointment')->with('delete', 'Success! The appointment has been cancelled');
}

public function understandAppointment(Appointment $appointment) {
    $appointment->delete();
    
    return redirect('/appointment')->with('understand', 'Thank you for your understanding.');
}

public function acceptAppointment(Appointment $appointment) {
    // Check for time conflicts for the specific counselor on the proposed date
    $existingAppointments = Appointment::where('counselor_id', auth()->user()->id)
        ->where('date', $appointment->date)
        ->where('status', 'approved')
        ->get();

    $proposedStart = Carbon::parse($appointment->date . ' ' . $appointment->time);
    $proposedEnd = $proposedStart->copy()->addMinutes(30);

    foreach ($existingAppointments as $existing) {
        $existingStart = Carbon::parse($existing->date . ' ' . $existing->time);
        $existingEnd = $existingStart->copy()->addMinutes(30);

        if ($proposedStart < $existingEnd && $proposedEnd > $existingStart) {
            // There's a time conflict
            $appointment->update(['status' => 'declined (Conflict of Schedule)']);
            $appointment->save();

            return redirect()->back()->with('decline', 'This appointment has been declined due to a time conflict.');
        }
    }

    // If no conflict, mark the appointment as approved
    $appointmentData = ['status' => 'approved'];

    // Set counselor_id to the authenticated user's id
    $appointmentData['counselor_id'] = auth()->user()->id;

    $appointment->update($appointmentData);
    $appointment->save();

    Mail::to($appointment->user->email)->send(new AppointmentAcceptedMail($appointment->user, $appointment));

    // Store the accepted appointment in the 'accepted_appointments' table
    $acceptedAppointment = new AcceptedAppointment;
    $acceptedAppointment->user_id = $appointment->user_id;
    $acceptedAppointment->appointment_id = $appointment->id;
    $acceptedAppointment->counselor_id = $appointmentData['counselor_id']; // Use the updated counselor_id
    $acceptedAppointment->save();

    return redirect()->back()->with('success', 'Appointment has been approved successfully.');
}




public function declineAppointment(Appointment $appointment) {
    
    if (auth()->user()->is_admin == 1) {
        $redirectPath = '/adminappointment';
    } elseif (auth()->user()->is_admin == 2) {
        // Check if the user is a guidance admin (assuming is_admin == 2 for guidance admin)
        $redirectPath = '/guidanceappointment';
    }
    $reason = request('reason'); // Get the reason from the form
    $appointment->update(['status' => 'declined (' . $reason . ')']);
    
    return redirect($redirectPath)->with('decline', 'Success! The appointment has been declined with reason: ' . $reason);
}


public function markAsDone($appointment)
{

   
    $appointment = Appointment::find($appointment);
    $studentNumber = $appointment->user->student_number;

    if ($appointment) {
        $appointment->deleteWithAcceptedAppointments();
        return view('counseling-records', ['studentNumber' => $studentNumber]);
    } else {
        // Handle the case where the appointment doesn't exist
    }
}


public function assignCounselor(Request $request, Appointment $appointment) {
    $request->validate([
        'counselor_id' => 'required|exists:users,id|numeric',
    ]);

    $appointment->update([
        'counselor_id' => $request->input('counselor_id'),
    ]);

    return redirect()->back()->with('success', 'Counselor assigned successfully.');
}

public function reschedStudent(Appointment $acceptedAppointment)
{
    // Get the associated appointment ID
    $appointmentId = $acceptedAppointment->id;

    $appointment = Appointment::findOrFail($appointmentId);
    $counselorId = $appointment->counselor_id;

    // Retrieve the counselor's name using the counselor_id
    $counselor = User::findOrFail($counselorId);
    $counselorName = $counselor->name;

    // Assuming you have access to student details from the $acceptedAppointment
    $studentFullName = $acceptedAppointment->user->name;
    $studentId = $acceptedAppointment->user->student_number;

    $chatifyUrl = "/chatify/{$counselorId}";

    // Delete the record from the 'accepted_appointments' table
    AcceptedAppointment::where('appointment_id', $appointmentId)->delete();

    // Delete the record from the 'appointments' table
    Appointment::where('id', $appointmentId)->delete();

    Mail::to('mindscapementalhealth331@gmail.com')->send(
        new StudentReschedMail(
            $counselorName, // Pass the counselor's name
            $studentFullName, // Pass the student's full name
            $studentId, // Pass the student's ID
            $acceptedAppointment
        )
    );

    // Redirect or respond as needed
    return redirect($chatifyUrl);
}

public function resched(Appointment $acceptedAppointment)
{
    // Get the associated appointment ID
    $appointmentId = $acceptedAppointment->id;

    $appointment = Appointment::findOrFail($appointmentId);
    $studentId = $appointment->user_id;

    $chatifyUrl = "/chatify/{$studentId}";
    
    // Delete the record from the 'accepted_appointments' table
    AcceptedAppointment::where('appointment_id', $appointmentId)->delete();

    // Delete the record from the 'appointments' table
    Appointment::where('id', $appointmentId)->delete();

   
   
    // Send an email to the student
    $studentEmail = $acceptedAppointment->user->email;

    Mail::to($studentEmail)->send(new RescheduleNotification($acceptedAppointment->user, $acceptedAppointment));

    // Redirect or respond as needed
    return redirect($chatifyUrl);
}

public function contactCounselor(Appointment $appointment) {

    $appointmentId = $appointment->id;
    $appointment = Appointment::findOrFail($appointmentId);
    $counselorId = $appointment->counselor_id;
    
    $chatifyUrl = "/chatify/{$counselorId}";

    return redirect($chatifyUrl);
}
}
