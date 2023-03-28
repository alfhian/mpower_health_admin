<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProfilingQuestion;
use Auth;

class InitialHealthProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function store($request) 
    {
        foreach($request->except('_token') as $keys => $item) {
            $profiling = new InitialHealthProfile;
            $key = substr($keys, 1);

            $question = ProfilingQuestion::find($key);
            if ($question->type == 'checkbox') {
                foreach($item as $value) {
                    $profiling = new InitialHealthProfile;
                    $profiling->client_id = Auth::id();
                    $profiling->question_id = $key;
                    $profiling->answer_id = $value;
                    $profiling->user_input = Auth::id();
                    $profiling->save();
                }
            } else {
                $profiling->client_id = Auth::id();
                $profiling->question_id = $key;

                if ($question->type == 'text' || $question->type == 'number' || $question->type == 'date') {
                    $profiling->answer_text = $item;
                } else {
                    $profiling->answer_id = $item;
                }

                $profiling->user_input = Auth::id();
                $profiling->save();
            }

        }

        return true;
    }
}
