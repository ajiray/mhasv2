<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Quote;
use App\Models\Comment;
use App\Models\Summary;
use App\Models\Resource;
use App\Models\Appointment;
use App\Models\PendingUser;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\DB;
use App\Models\AcceptedAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
    $this->middleware('auth')->except(['contactUs', 'terms', 'policy']);
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
{
    $events = Event::where('date', '>=', now())->orderBy('date')->get();
    $counselors = User::whereIn('is_admin', [1, 2])->where('online', 1)->get();

    return view('dashboard', compact('events', 'counselors'));
}

    public function messagegoback() {
    $user = Auth::user();

    if ($user && ($user->is_admin === 1 || $user->is_admin === 2)) {
        return redirect('/admindashboard');
    } else {
        return view('messageOption');
    }
}

    public function wall()
    {
        $comments = Comment::all();
        $posts = Post::all();
        
        return view('wall', ['posts' => $posts, 'comments' => $comments]);
    }   
    public function videocall() {

        // Get all notifications for the user

    return view('videocallhomepage');
    }
    

    public function message() {
        return view('message');
    }

    public function chatbot() {
        return view('chatbotMain');
    }

    public function messageOption() {
        return view('messageOption');
    }

    public function newUser() {
        return view('newUser');
    }

    public function appointment() {
        // Count the number of counselors
        $numberOfCounselors = User::where('is_admin', 1)->count();
    
        // Get all appointments and booked date and time
        $appointments = Appointment::all()->sortBy(function ($appointment) {
            return $appointment->date . ' ' . $appointment->time;
        });
    
        // Get booked date and time
        $bookedTimes = $appointments->map(function ($appointment) {
            return $appointment->date . ' ' . $appointment->time;
        })->toArray();

        $numberOfCounselors = User::whereIn('is_admin', [1, 2])->count();
        
        
    
        return view('appointment', [
            'appointments' => $appointments,
            'bookedTimes' => $bookedTimes,
            'numberOfCounselors' => $numberOfCounselors,
        ]);
    }
    

    public function profile() {
       
        return view('profile');
    }

    public function resources() {
        return view('resources');
    }


    
    public function adminHome()
    {
        $pendingUsers = PendingUser::all();
        return view('admindashboard', compact('pendingUsers'));
    }

    public function adminWall()
    {
        $posts = Post::all();
        return view('adminwall', ['posts' => $posts]);
    }

    public function adminappointment()
{
    $counselor = Auth::user();
    $appointments = Appointment::all()->sortBy(function ($appointment) {
        return $appointment->date . ' ' . $appointment->time;
    });

    $acceptedAppointments = AcceptedAppointment::where('counselor_id', $counselor->id)
    ->get()
    ->sortBy(function ($acceptedAppointment) {
        return $acceptedAppointment->appointment->date . '' . $acceptedAppointment->appointment->time;
    });

    $counselors = User::where('is_admin', 2)
    ->whereDoesntHave('appointment')
    ->get();

    return view('adminappointment', [
        'appointments' => $appointments,
        'acceptedAppointments' => $acceptedAppointments,
        'counselors' => $counselors,
    ]);
}

    public function adminmessage()
    {
        return view('adminmessage');
    }

    public function adminresources()
    {
        $resources = Resource::all();
        return view('adminresources', ['resources' => $resources]);
    }

    public function guidancedashboard() {
        return view('guidancedashboard');
    }

    public function guidanceappointment() {
        // Get the currently authenticated user (counselor)
        $counselor = Auth::user();
        
        $acceptedAppointments = AcceptedAppointment::where('counselor_id', $counselor->id)
        ->get()
        ->sortBy(function ($acceptedAppointment) {
            return $acceptedAppointment->appointment->date . '' . $acceptedAppointment->appointment->time;
        });
          
        // Retrieve all appointments where counselor_id matches the logged-in counselor's ID
        $appointments = Appointment::where('counselor_id', $counselor->id)->get();
    
        return view('guidanceappointment', ['appointments' => $appointments, 'acceptedAppointments' => $acceptedAppointments]);
    }

    public function guidancewall()
    {
        $posts = Post::all();
        return view('guidancewall', ['posts' => $posts]);
    }

    public function guidanceresources() {
        $resources = Resource::all();
        return view('guidanceresources', ['resources' => $resources]);
    }

    public function showCounselingRecordsForm(){
        return view('counseling-records');
    }

    public function contactUs(Request $request) {
        $data = $request->only(['name', 'email', 'message']);
    
        // Send email
        Mail::to('mindscapementalhealth331@gmail.com')->send(new ContactFormMail($data));
    
        // Redirect back to the contact section with a success message
        return Redirect::to('/#contact')->with('success', 'Email sent successfully!');
    }
    
     public function terms() {
        return view('terms');
    }
    public function policy() {
        return view('policy');
    }
    public function summary()
    {
        // Get all users with is_admin equal to 1 or 2
        $counselors = User::whereIn('is_admin', [1, 2])->get();

        $programs = Summary::distinct('course')->pluck('course');

        $reasons = Summary::distinct('reason')->pluck('reason');
    
        $summaries = Summary::all(); // You may need to adjust this based on your logic
        $totalSummaries = Summary::count();
    
        return view('summary', ['summaries' => $summaries, 'counselors' => $counselors, 'programs' => $programs, 'reasons' => $reasons, 'totalSummaries' => $totalSummaries]);
    }

    public function registerGuidance(Request $request) {

        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'fullname' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'firstname' => 'nullable|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'studnum' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
            'userType' => 'required|integer',
        ]);
        
        // Create a new user in the database based on is_admin
        
        if ($validatedData['userType'] == 1 || $validatedData['userType'] == 2) {

            $password = bcrypt($validatedData['password']);
            // Guidance or admin registration
            User::create([
                'firstname' => $validatedData['fullname'],
                'email' => $validatedData['email'],
                'password' => $password,
                'is_admin' => $validatedData['userType'],
            ]);
            
    
            return redirect()->back()->with(['successs' => 'Account created successfully.']);
        } else {
            
            // Student registration
            $password = bcrypt($validatedData['lastname']); // Use last name as password
            User::create([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'student_number' => $validatedData['studnum'],
                'course' => $validatedData['course'],
                'is_admin' => $validatedData['userType'],
                'password' => $password,
            ]);
            
            return redirect()->back()->with(['successs' => 'Student account created successfully.']);
        }
    }
    
    public function addstudents() {
        return view('adminaddnewstudent');
    }
}
