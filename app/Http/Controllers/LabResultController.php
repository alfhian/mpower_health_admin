<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use App\Models\UserInformation;
use App\Models\LabResult;
use App\Models\LogManagement;

use Auth;

class LabResultController extends Controller
{
    public function index() {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open Admin Lab Result page'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $user       = Auth::user();
        $profile    = UserInformation::find($user->id);

        $lab_result = LabResult::getLabResultAdmin();

        $data = [
            'user_id'   => $user->id,
            'firstname' => $profile->firstname,
            'photo'     => $user->profile_photo_path,
            'role'      => $user->role_id,
            'lab_result'=> $lab_result
        ];

        return view('admin.lab_result.index', $data);
    }

    public function showFile($file) {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'file_name' => $file,
            'file_path' => '/storage/lab_results/'.$file,
            'url'       => url()->current(),
            'action'    => 'View Lab Result',
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        // Decrypt file content
        $decrypted = Crypt::decrypt(Storage::get('public/lab_results/'.$file));

        // Get file type
        $mime_type  = Storage::mimeType('public/lab_results/'.$file);

        return view('layouts.show_file', ['file' => $decrypted, 'type' => $mime_type]);
    }
}
