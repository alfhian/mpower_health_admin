<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Actions\Fortify\PasswordValidationRules;

use Laravel\Fortify\Rules\Password;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserInformation;
use App\Models\Role;
use App\Models\LogManagement;

use Auth;

class UserManagementController extends Controller
{
    use PasswordValidationRules;
    
    public function index() {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open User Management Page'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $user       = Auth::user();
        $profile    = UserInformation::find($user->id);

        $users = User::getAllUsers();
        $roles = Role::where('id', '<>', 1)->get();

        $data = [
            'user_id'   => $user->id,
            'firstname' => $profile->firstname,
            'photo'     => $user->profile_photo_path,
            'role'      => $user->role_id,
            'roles'     => $roles,
            'user'      => $users
        ];

        return view('admin.user_management.index', $data);
    }
    
    public function status(Request $request) {

        // Set up the message
        if ($request->status_check == 'on') {
            $status     = 'N';
            $message    = 'User has been deactivated';
            $action     = 'Deactivate internal user';
        } else {
            $status     = 'Y';
            $message    = 'User has been activated';
            $action     = 'Activate internal user';
        }

        // Update user status
        $update = User::changeStatus($request);
        
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => $action,
            'data_id'   => $request->id,
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        return back()->with('success', $message);
    }

    public function store(Request $request) {
        $email = User::where('email', $request->email)->get();

        // Check the email if exist
        if(!$email->isEmpty()) {
            return back()->with('error', 'The email has already been taken.');
        }

        // Create the new user
        $add_user = User::store($request);

        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Add new internal user',
            'data_id'   => $add_user[0]['id'],
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        return back()->with('success', 'New user has been created');
    }

    public function reset_password(Request $request) {
        $request->validate([
            'password' => ['required', 'string', (new Password)->requireUppercase()->requireNumeric()->requireSpecialCharacter()],
        ]);

        $reset_password = User::reset_password($request);

        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Reset Password for internal user',
            'data_id'   => $request->reset_id,
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        return back()->with('success', 'Password has been reset');
    }
}
