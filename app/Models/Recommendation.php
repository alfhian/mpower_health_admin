<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use DB;
use Auth;

class Recommendation extends Model
{
    use HasFactory;
    
    protected $dates = ['deleted_at'];

    protected $casts = [
        'recommendation'    => 'encrypted',
        'file_path'         => 'encrypted',
    ];

    public static function getAllData()
    {
        $data = Recommendation::select('recommendations.*', 'b.lab_result_no', 'b.lab_result', DB::raw('DATE_FORMAT(recommendations.created_at, "%b %e, %Y") as upload_date'))
                ->leftJoin('lab_results as b', 'b.recommendation_id', 'recommendations.id')
                ->where('client_id', Auth::id())
                ->orderBy('recommendations.created_at', 'desc')
                ->orderBy('b.created_at', 'desc')
                ->get();

        return $data;
    }

    public static function getTopThree()
    {
        $data = Recommendation::select('recommendations.*', 'b.lab_result_no', 'b.lab_result', DB::raw('DATE_FORMAT(recommendations.created_at, "%b %e, %Y") as upload_date'))
                ->leftJoin('lab_results as b', 'b.recommendation_id', 'recommendations.id')
                ->where('client_id', Auth::id())
                ->orderBy('recommendations.created_at', 'desc')
                ->orderBy('b.created_at', 'desc')
                ->take(3)
                ->get();

        return $data;
    }

    public static function store($request) 
    {
        $recommendation = new Recommendation;

        $file       = $request->lab_report;
        $file_name  = time().'_'.$file->getClientOriginalName();

        Storage::put('public/recommendations/'.$file_name, Crypt::encrypt($file->getContent()));

        /*$file_path = $file->storeAs('recommendations', $file_name, 'public');*/

        $file_path = Storage::url('public/recommendations/'.$file_name);

        $recommendation->recommendation = $file_name;
        $recommendation->file_path      = $file_path;
        $recommendation->user_input     = Auth::id();
        $recommendation->save();

        $recommendation_id = Recommendation::where('user_input', Auth::id())
                            ->orderBy('created_at', 'desc')->take(1)->get();

        $labResult = LabResult::find($request->lab_result_id);
        
        $labResult->recommendation_id = $recommendation_id[0]['id'];
        $labResult->save();

        return $recommendation;
    }
}
