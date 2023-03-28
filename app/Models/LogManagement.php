<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;

class LogManagement extends Model
{
    use HasFactory;

    protected $casts = [
        'ip'            => 'encrypted',
        'data_id'       => 'encrypted',
        'file_name'     => 'encrypted',
        'file_path'     => 'encrypted',
        'url'           => 'encrypted',
        'latitude'      => 'encrypted',
        'longitude'     => 'encrypted',
    ];

    public static function store($log_data, $log_detail) {
        if($log_data == false) {
            return true;
        }
        
        $data = new LogManagement;

        $data->ip           = $log_data->ip;
        $data->url          = $log_detail['url'];
        $data->log          = $log_detail['action'];
        $data->data_id      = array_key_exists('data_id', $log_detail) ? $log_detail['data_id'] : null;
        $data->file_name    = array_key_exists('file_name', $log_detail) ? $log_detail['file_name'] : null;
        $data->file_path    = array_key_exists('file_path', $log_detail) ? $log_detail['file_path'] : null;
        $data->latitude     = $log_data->latitude;
        $data->longitude    = $log_data->longitude;

        // Check if the user already logged in
        // If yes then use the user's id, else use the IP address for user_input field
        if(Auth::check()) {
            $data->user_input = Auth::id();
        } else {
            $data->user_input = null;
        }

        $data->save();

        return $data;
    }

    public static function getLog() {
        $data = LogManagement::select('log_management.*', DB::raw('b.email as user_id'))
                ->leftJoin('users as b', 'b.id', 'log_management.user_input')
                ->orderBy('log_management.created_at', 'desc')
                ->get();
                
        return $data;
    }

    public static function detail($filter) {
        $data = LogManagement::select('log_management.*', DB::raw('b.email as user_id'))
                ->leftJoin('users as b', 'b.id', 'log_management.user_input')
                ->where('log_management.id', $filter)
                ->get();

        return $data;
    }

    public static function export($request) {
        $data = LogManagement::select('log_management.*', DB::raw('b.email as user_id'))
                ->leftJoin('users as b', 'b.id', 'log_management.user_input')
                ->whereRaw("DATE_FORMAT(log_management.created_at, '%Y-%m-%d') BETWEEN ? AND ?", [$request->start_date, $request->end_date])
                ->get();

        return $data;
    }

    public static function export_excel($request) {
        $data = LogManagement::select('log_management.id', 'log_management.ip', 'log_management.url', 'log_management.log', 'log_management.data_id', 'log_management.file_name', 'log_management.file_path', 'log_management.latitude', 'log_management.longitude', DB::raw('b.email as user_id'), 'log_management.created_at')
                ->leftJoin('users as b', 'b.id', 'log_management.user_input')
                ->whereRaw("DATE_FORMAT(log_management.created_at, '%Y-%m-%d') BETWEEN ? AND ?", [$request->start_date, $request->end_date])
                ->get();

        return $data;
    }
}
