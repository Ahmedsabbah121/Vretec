<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Route;
use validator;
class AdminRegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }
    public function showRegisterForm(){
        return view('admins.register');
    }

    public function register(Request $request){

        $this->validate($request , [
            'name' => 'required',
            'email'  =>  'required|email',
            'password'  => 'required|min:6'
        ]);

             Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

                    return redirect()->intended(route('admin.dashboard'));

        // Attempt to log the user in
        // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //     // if successful, then redirect to their intended location
        //     return redirect()->intended(route('admin.dashboard'));
        // }
        // // if unsuccessful, then redirect back to the login with the form data
        // return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
