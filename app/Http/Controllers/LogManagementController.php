<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\LogManagementExport;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\LogManagement;

use Auth;
use PDF;

class LogManagementController extends Controller
{
    public function index() {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open Log Management Page'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $user       = Auth::user();
        $profile    = UserInformation::find($user->id);
        $log        = LogManagement::getLog();

        $data = [
            'user_id'   => $user->id,
            'firstname' => $profile->firstname,
            'photo'     => $user->profile_photo_path,
            'role'      => $user->role_id,
            'log'       => $log
        ];

        return view('admin.log_management.index', $data);
    }

    public function detail($filter) {
        // Save Log
        $log_data   = \Location::get();
        $log_detail = [
            'url'       => url()->current(),
            'action'    => 'Open Log Management Detail'
        ];
        $log        = LogManagement::store($log_data, $log_detail);

        $detail = LogManagement::detail($filter);

        $data = [
            'detail' => $detail
        ];

        return view('admin.log_management.detail', $data);
    }

    public function export_pdf(Request $request)
    {
    	$log = LogManagement::export($request);
 
    	$pdf = PDF::loadview('admin.log_management.export_pdf', ['log' => $log, 'start_date' => $request->start_date, 'end_date' => $request->end_date])->setPaper('a4', 'landscape');

        if ($request->start_date != null && $request->end_date != null) {
            return $pdf->download('log_' . $request->start_date . '_' . $request->end_date . '.pdf');    
        }

        return $pdf->download('log.pdf');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export_excel(Request $request) 
    {
        return Excel::download(new LogManagementExport($request), 'log.xlsx');
    }
}