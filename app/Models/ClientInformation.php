<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;

class ClientInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $casts = [
        'firstname'         => 'encrypted',
        'lastname'          => 'encrypted',
        'birthdate'         => 'encrypted',
        'phone_number'      => 'encrypted',
        'street_address'    => 'encrypted',
        'street_address_2'  => 'encrypted',
        'city'              => 'encrypted',
        'state_province'    => 'encrypted',
        'postal_code'       => 'encrypted',
        'country'           => 'encrypted',
    ];

}
