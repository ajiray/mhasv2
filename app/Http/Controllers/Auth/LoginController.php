<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\EnrolledStudent;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $request->validate([
            'login_identifier' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'password' => $request->password,
        ];

        $adminCredentials = ['email' => $request->login_identifier] + $credentials;
        $counselorCredentials = ['email' => $request->login_identifier] + $credentials;

        if (auth()->attempt($adminCredentials + ['is_admin' => 1])) {
            $user = auth()->user();
            $user->update(['online' => 1]);
            return redirect('admindashboard');
        }

        if (auth()->attempt($counselorCredentials + ['is_admin' => 2])) {
            $user = auth()->user();
            $user->update(['online' => 1]);
            return redirect('guidancedashboard');
        }

        $studentCredentialsByNumber = ['is_admin' => 0, 'password' => $request->password, 'student_number' => $request->login_identifier] + $credentials;

        if (auth()->attempt($studentCredentialsByNumber)) {
            $user = auth()->user();

            if ($user->first_login) {
                return redirect()->route('password.change');
            }

            return redirect('dashboard');
        }

        return redirect()->route('login')->with('status', 'Invalid login credentials');
    }
    


}