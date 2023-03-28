<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInformation extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $casts = [
        'firstname'     => 'encrypted',
        'middlename'    => 'encrypted',
        'lastname'      => 'encrypted',
        'phone_number'  => 'encrypted',
    ];
}
