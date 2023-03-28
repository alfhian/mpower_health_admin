<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\ClientInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthdate' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:13'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:50'],
            'postal_code' => ['required', 'string', 'max:6'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        
        $user = User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => 1,
            'user_input' => 'REGISTRATION'
        ]);

        $client = User::where('email', $input['email'])->get();

        $update_user = User::find($client[0]['id']);
        $update_user->role_id = 1;
        $update_user->user_input = $client[0]['id'];
        $update_user->save();

        ClientInformation::create([
            'client_id' => $client[0]['id'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'birthdate' => $input['birthdate'],
            'phone_code' => $input['phone_code'],
            'phone_number' => $input['phone_number'],
            'street_address' => $input['street_address'],
            'street_address_2' => $input['street_address_2'],
            'city' => $input['city'],
            'state_province' => $input['state_province'],
            'postal_code' => $input['postal_code'],
            'country' => $input['country'],
            'user_input' => $client[0]['id'],
        ]);

        return $user;
    }
}
