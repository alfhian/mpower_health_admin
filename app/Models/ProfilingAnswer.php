<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilingAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function answerQuestion($questionId)
    {
        $data = ProfilingAnswer::where('question_id', $questionId)->get();

        return $data;
    }
}
