<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use App\Models\UserInformation;
use App\Models\Recommendation;
use App\Models\LabResult;
use App\Models\LogManagement;

use Auth;

class RecommendationController extends Controller
{
    public function claim(Request $request) {
        $id = $request->claim;

        $labResult              = LabResult::find($id);
        $labResult->claim       = 'Y';
        $labResult->user_claim  = Auth::id();
        $labResult->save();
        
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Claim Lab Result',
            'data_id'   => $request->claim,
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        return back()->with('success', 'Lab Result has been claimed');
    }

    public function upload(Request $request) {
        // Recommendation file validation
        Validator::make($request->all(), [
            'lab_report' => ['required', 'mimes:pdf', 'max:2048'],
        ], [
            'lab_report.max' => 'The lab report must not be greater than 2 Mb'
        ])->validate();
        
        $store = Recommendation::store($request);
        
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Upload Recommendation Report',
            'data_id'   => $store->id,
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        return back()->with('success', 'Recommendation report has been uploaded');
    }

    public function showFile($file) {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'file_name' => $file,
            'file_path' => '/storage/recommendations/'.$file,
            'url'       => url()->current(),
            'action'    => 'View Recommendation Report'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        // Get file content
        $file_content = file_get_contents('storage/recommendations/'.$file);

        // Decrypt file content
        $decrypted = Crypt::decrypt($file_content);

        // Open file info and get the file type
        $f          = finfo_open();
        $mime_type  = finfo_buffer($f, $decrypted, FILEINFO_MIME_TYPE);

        return view('layouts.show_file', ['file' => $decrypted, 'type' => $mime_type]);
    }
}
