<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Http\Responses\VerifyEmailResponse as FortifyVerifyEmailResponse;

class VerifyEmailResponse extends FortifyVerifyEmailResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request)
    {
        $data = 'test';
        return redirect('/register', ['data' => $data])->with('message','Verification Success !');
    }
}