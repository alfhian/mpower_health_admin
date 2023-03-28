<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Mail\SendCredentialsMail;

use Exception;
use Mail;
use Hash;
use Auth;
use DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'status',
        'user_input',
        'user_update',
        'user_delete'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'firstname'         => 'encrypted',
        'lastname'          => 'encrypted',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function getAllUsers()
    {
        /*
        $client = User::select('users.*', 'b.firstname', 'b.lastname', 'c.role')
                ->join('client_information as b', 'b.client_id', 'users.id')
                ->leftJoin('roles as c', 'c.id', 'users.role_id');

        $user = User::select('users.*', 'b.firstname', 'b.lastname', 'c.role')
                ->join('user_information as b', 'b.id', 'users.id')
                ->leftJoin('roles as c', 'c.id', 'users.role_id')
                ->union($client)
                ->orderBy('firstname', 'asc')
                ->get();

        return $user;
        */

        $user = User::select('users.*', 'b.firstname', 'b.lastname', 'c.role')
                ->join('user_information as b', 'b.id', 'users.id')
                ->leftJoin('roles as c', 'c.id', 'users.role_id')
                ->orderBy('firstname', 'asc')
                ->get();

        return $user;
    }

    public static function store($request) {
        $user = New User;

        $user->email        = $request->email;
        $user->password     = Hash::make('Mpower123!');
        $user->role_id      = $request->role;
        $user->user_input   = Auth::id();
        $user->save();

        $user = User::where('email', $request->email)->get();

        $user_information = New UserInformation;
        
        $user_information->id           = $user[0]['id'];
        $user_information->firstname    = $request->firstname;
        $user_information->middlename   = $request->middlename;
        $user_information->lastname     = $request->lastname;
        $user_information->position     = $request->position;
        $user_information->user_input   = Auth::id();
        $user_information->save();

        // Send notification email for user credentials to inform new internal users
        $details = [
            'email'     => $request->email,
            'password'  => 'Mpower123!',
            'firstname' => $request->firstname,
        ];

        Mail::to($request->email)->send(new SendCredentialsMail($details));

        return $user;
        
    }

    public static function reset_password($request) {
        $user = User::find($request->reset_id);

        $user->password     = Hash::make($request->password);
        $user->user_update  = Auth::id();
        $user->save();

        return $user;
    }

    public static function changeStatus($request) {
        $user = User::find($request->id);

        $user->status       = $request->status_check == 'on' ? 'N' : 'Y';
        $user->user_update  = Auth::id();
        $user->save();

        return $user;
    }

    public static function checkLimit($email) {
        // Check the reset password limit
        $limit = User::select('reset_password_limit')
                    ->where('email', $email)
                    ->get();

        return $limit;
    }
}
