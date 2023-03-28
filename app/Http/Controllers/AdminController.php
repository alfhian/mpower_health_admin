<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\StatefulGuard;

use App\Models\UserInformation;
use App\Models\LabResult;
use App\Models\User;
use App\Models\LogManagement;

use Auth;
use Session;
use Redirect;

class AdminController extends Controller
{
    public function index() {

        // Check if the user already logged in
        // And check the role of the user
        // If the role is not client then redirect to admin dashboard
        if(Auth::check()) {
            if(Auth::user()->role_id != 1) {
                return redirect()->route('admin_dashboard');
            }
        }

        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open Admin login page'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        // Redirect to login page if the user has not logged in or the role is not clerk, admin and super admin
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Admin Login Attempt',
            'data_id'   => $request->email,
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);
   
        // Login attempt
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role_id != 1) {
                if($user->status == 'N') {
                    Session::flush();
                    Auth::logout();
                    
                    return redirect()->route('login')->with('error', 'Your account has been deactivated. Please contact the administrator for further details');
                }
                return Redirect::intended(route('admin_dashboard'));
            } else {
                Session::flush();
                Auth::logout();

                return redirect()->route('login')->with('error', 'Login details are not valid');
            }
        }
  
        return redirect()->route('login')->with('error', 'Login details are not valid');
    }

    public function dashboard() {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open Admin Dashboard page'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $user       = Auth::user();
        $profile    = UserInformation::find($user->id);
        $lab_result = LabResult::getLabResultAdmin();
        $users      = User::getAllUsers();

        $data = [
            'user_id'   => $user->id,
            'firstname' => $profile->firstname,
            'photo'     => $user->profile_photo_path,
            'role'      => $user->role_id,
            'lab_result'=> $lab_result,
            'user'      => $users
        ];

        return view('admin.dashboard.index', $data);
    }
}
