@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row my-5 py-5">
            <div class="col-md-6 d-flex justify-content-center mb-5">
                <img src="{{ asset('img/admin-login.png') }}" alt="admin login" width="600">
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="w-75 my-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="sato text-purple text-center mb-4"><b>Sign In</b></h5>
                            <form method="POST" action="{{ route('admin_login') }}">
                                @csrf
                                @if ($errors->any())
                                    @if (property_exists(json_decode($errors), 'email'))
                                        @if (json_decode($errors)->email[0] != 'The email field is required.')
                                            <div class="redhat text-danger small-text mb-2 spacing-1 text-center">
                                                <span>{{ json_decode($errors)->email[0] }}</span>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                @if ($message = Session::get('error'))
                                    <div class="alert p-2 alert-danger alert-dismissible fade show" id="message-alert"
                                        role="alert">
                                        <strong class="redhat med-text">{{ $message }}</strong>
                                        <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if ($message = Session::get('success'))
                                    <div class="alert p-2 alert-success alert-dismissible fade show" id="message-alert"
                                        role="alert">
                                        <strong class="redhat med-text">{{ $message }}</strong>
                                        <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mb-2">
                                    <label for="email-login" class="form-label redhat small-text text-purple"
                                        style="margin-left: 10px;"><b>E-mail</b></label>
                                    <input type="email" class="form-control form-control-sm input-gray  "
                                        style="margin-top: -15px;" id="email-login" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password-login" class="form-label redhat small-text text-purple"
                                        style="margin-left: 10px;"><b>Password</b></label>
                                    <input type="password" class="form-control form-control-sm input-gray"
                                        id="password-login" name="password" style="margin-top: -15px;"required>
                                </div>
                                <div class="w-100 my-2">
                                    <button class="btn w-100 bg-purple sato small-text text-white spacing-1">SIGN
                                        IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
