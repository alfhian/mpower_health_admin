<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\UserInformation;
use App\Models\LogManagement;

use Auth;

class ProfileManagementController extends Controller
{
    use PasswordValidationRules;

    public function index() {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open Profile Management Page'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $user       = Auth::user();
        $profile    = UserInformation::where('id', $user->id)->get();

        $data = [
            'data'      => $profile,
            'client_id' => $user->id,
            'email'     => $user->email,
            'firstname' => $profile[0]['firstname'],
            'photo'     => $user->profile_photo_path,
            'role'      => $user->role_id
        ];

        return view('admin.profile_management.index', $data);
    }

    public function edit(Request $request) {
        $edit = ClientInformation::edit($request);
        
        return back()->with('success', 'Profile has been updated');
    }

    public function change_password(Request $request) {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'same:password']
        ]);

        // Validation for same password as the current password
        if ($request->current_password == $request->password) {
            return back()->with('error', 'New password cannot be the same as the current password');
        }

        $user = $request->user();

        // Update the user password
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Change Password from Profile Management Page',
            'data_id'   => Auth::id(),
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        return back()->with('success', 'Password has been changed');
    }
}
