<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Cookie;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Function to display login view

    public function login()
    {
        return view('login');
    }

    // Function to log out, exit the session and forget employeeID

    public function logout(Request $request){
        $request->session()->forget('employeeID');
        return redirect()->route('login');
    }

    // Function to validate login credentials

    public function loginPost(Request $request)
    {
        $request->validate([
            'employeeID' => 'required',
            'password' => 'required',
        ]);

        $employee = Employee::where('employeeID', $request->employeeID)->first();

        if ($employee && $employee->password === $request->password) {
            // Authentication successful
            // Store employee ID in the session
            $request->session()->put('employeeID', $employee->employeeID);

            // Create a cookie to store login data if remember me checkbox is ticked

            if($request->has('rememberme')){
                $time = 60*24*30; // Stores the cookie for 30 days
                $cookieData = [
                    'employeeID'=>$employee->employeeID,
                    'password'=>$employee->password
                ];

                // Creates a cookie and encrypts the contents with JSON Encode
                $rememberMeCookie = cookie('remember_me', encrypt(json_encode($cookieData)), $time);

                // Attaches the cookie when redirecting to homepage
                return redirect()->intended(route('home'))->withCookie($rememberMeCookie);
            }

            return redirect()->intended(route('home'));
        }

        // Authentication failed error message
        return redirect(route('login'))->withErrors(['employeeID' => 'Invalid login details']);
    }

    public function showProfile(Request $request)
    {
        // Retrieve employee information based on ID
        $employeeID = $request->session()->get('employeeID');
        $employee = Employee::where('employeeID', $employeeID)->first();

        return view('navbar', ['employee' => $employee]);
    }
}
