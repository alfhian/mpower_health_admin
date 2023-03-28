<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Auth;

class ProfilingQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function questionStep($step, $position)
    {
        $data = ProfilingQuestion::where('step', $step)->where('position', $position)->orderBy('order', 'asc')->get();

        return $data;
    }

}
