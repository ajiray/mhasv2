<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendingUser;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneratedPasswordEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::REGISTER;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'student_number' => ['required', 'string', 'max:30'],
            'course' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);
    }

    protected function create(array $data)
    {
        // Check if the data matches records in the enrollment_records table
        $enrollmentRecord = Enrollment::where([
            'fullname' => $data['name'],
            'email' => $data['email'],
            'student_number' => $data['student_number'],
            'course' => $data['course'],
            'birthday' => $data['birthday'],
        ])->first();

        if (!$enrollmentRecord) {
            // Data doesn't match enrollment records, decline registration
            session()->flash('registration_failed', 'You are not enrolled in this institution.');
            return redirect($this->redirectTo);
        }

        // Proceed with the registration logic
        $temporaryPassword = Str::random(12);
        $birthday = Carbon::parse($data['birthday']);
        $age = $birthday->age;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'student_number' => $data['student_number'],
            'course' => $data['course'],
            'age' => $age,
            'birthday' => $data['birthday'],
            'password' => Hash::make($temporaryPassword),
        ]);

        Mail::to($user->email)->send(new GeneratedPasswordEmail($user, $temporaryPassword));

        session()->flash('registration_success', 'Your Account has been Created, Check your email for the Temporary Password and use it to login. Thank You!');
        return redirect($this->redirectTo);
    }
}
