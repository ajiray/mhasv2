<?php

namespace App\Http\Controllers;
use App\Models\CounselingRecord;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CounselingRecordController extends Controller
{
    // CounselingRecordController.php

    public function error(){
        return view('counseling-records')->with('error','No User Found.');
    }
    public function mainScreen()
    {
        // Your existing logic for the main screen

        return view('counseling-records'); // Assuming your main screen view is named 'main-screen.blade.php'
    }
    public function search(Request $request)
{
    $request->validate([
        'search' => 'required|string',
    ]);

    $studentNumber = $request->input('search');

    // Assuming 'student_number' is the column in the 'users' table
    $user = User::where('student_number', $studentNumber)->first();

    if (!$user) {
        return redirect('errorcode')->with('error', 'No User Found.');
    }

    // Retrieve counseling records for the user
    $counselingRecords = CounselingRecord::where('user_id', $user->id)->get();

    return view('counseling-records', compact('counselingRecords', 'studentNumber', 'user'));
}

    
    

public function edit($id)
{
    // Fetch the counseling record by ID
    $counselingRecord = CounselingRecord::find($id);

    return view('counseling-records', compact('counselingRecord'));
}

public function create(Request $request)
{
    $validatedData = $request->validate([
        'findings' => 'required|string',
        'presentconditions' => 'required|string',
        'conclusions' => 'required|string',
        'recommendations' => 'required|string',
        'difficulties' => 'required|string',
        'backgroundOfStudy' => 'required|string',
        // Add validation rules for other fields as needed
    ]);

    $studentId = $request->input('student_id');
    $student = User::find($studentId);
    $user = Auth::user();

    if (!$student) {
        return redirect()->back()->with('error', 'Selected student not found');
    }

    // Create and save the CounselingRecord
    $counselingRecord = new CounselingRecord();
    $counselingRecord->user_id = $student->id;
    $counselingRecord->findings = $validatedData['findings'];
    $counselingRecord->present_conditions = $validatedData['presentconditions'];
    $counselingRecord->conclusions = $validatedData['conclusions'];
    $counselingRecord->recommendations = $validatedData['recommendations'];
    $counselingRecord->difficulties = $validatedData['difficulties'];
    $counselingRecord->background_of_study = $validatedData['backgroundOfStudy'];
    $counselingRecord->counseled_by = $user->name;
    // Set other fields accordingly

    $counselingRecord->save();

    return redirect()->route('main-screen')->with('success', 'Records Added Successfully.');
}

}









