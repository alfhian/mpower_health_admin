<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Crypt;

use DB;
use Auth;

class LabResult extends Model
{
    use HasFactory;
    
    protected $dates = ['deleted_at'];

    protected $casts = [
        'firstname'                 => 'encrypted',
        'lastname'                  => 'encrypted',
        'clerk_firstname'           => 'encrypted',
        'clerk_lastname'            => 'encrypted',
        'lab_result'                => 'encrypted',
        'file_path'                 => 'encrypted',
        'recommendation'            => 'encrypted',
        'recommendation_file_path'  => 'encrypted',
    ];

    public static function getLabResultAdmin()
    {
        $data = labResult::select('lab_results.*', 'b.file_path as recommendation_file_path', 'b.recommendation', 'b.user_input as admin', 'c.firstname', 'c.lastname', 'd.firstname as clerk_firstname', 'd.lastname as clerk_lastname', DB::raw('DATE_FORMAT(lab_results.created_at, "%b %e, %Y") as upload_date'))
                ->leftJoin('recommendations as b', 'b.id', 'lab_results.recommendation_id')
                ->leftJoin('client_information as c', 'c.id', 'lab_results.client_id')
                ->leftJoin('user_information as d', 'd.id', 'lab_results.user_claim')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->get();

        return $data;
    }
}
