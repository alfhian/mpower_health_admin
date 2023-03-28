@extends('layouts.main')

@section('content')
    <div class="modal fade" id="changePasswordModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="redhat text-purple text-center mb-3"><b>Change Password</b></h5>
                    <form method="POST" action="{{ url('profile_management/change_password') }}" id="change-password-form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="d-flex justify-content-center my-3">
                            <div class="position-relative text-start">
                                <label for="current_password" class="form-label redhat med-text text-purple m-0"><b>Current
                                        Password</b></label>
                                <div class="input-group">
                                    <input id="current_password" class="form-control form-control-sm input-gray"
                                        type="password" name="current_password" required />
                                    <button class="btn btn-sm input-gray" type="button" id="button-visible">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </button>
                                </div>
                                <label for="password" class="form-label redhat med-text text-purple m-0"><b>New
                                        Password</b></label>
                                <div class="position-relative mb-2">
                                    <div class="input-group">
                                        <input id="password" class="form-control form-control-sm input-gray"
                                            style="z-index: 50" type="password" name="password"
                                            aria-describedby="button-visible1"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            required />
                                        <button class="btn btn-sm input-gray" type="button" id="button-visible1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="password_message" class="redhat small-text text-danger spacing-half"
                                        style="display: none">
                                        <span></span>
                                    </div>
                                    <div class="position-absolute w-100 top-0">
                                        <button type="button" class="px-1 py-0 float-end bg-transparent border-0"
                                            style="margin-right: -2rem;" id="psw-tooltip" data-bs-toggle="tooltip"
                                            data-bs-placement="right" data-bs-trigger="manual" data-bs-html="true"
                                            data-bs-title="<b></b>Password must:<ul><li>Be a minimun 8 characters</li><li>Include at least one lowercase letter (a-z)</li><li>Include at least one uppercase letter (A-Z)</li><li>Include at least one number (0-9)</li><li>Include at least one special character</li></ul>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <label for="password_confirmation"
                                    class="form-label redhat med-text text-purple m-0"><b>Confirm
                                        Password</b></label>
                                <div class="input-group">
                                    <input id="password_confirmation" class="form-control form-control-sm input-gray"
                                        type="password" name="password_confirmation" required />
                                    <button class="btn btn-sm input-gray" type="button" id="button-visible2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="pswconfirm_message" class="redhat small-text text-danger spacing-half"
                                    style="display: none">
                                    <span>Password do not match</span>
                                </div>
                                <button
                                    class="btn btn-sm w-100 bg-purple redhat med-text text-white shadow spacing-1 px-5 my-3"><b>SAVE</b></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="dashboard-container d-flex">
        @include('layouts.sidebar')
        <div class="dashboard container-fluid m-0 px-3 pt-5">
            <div class="row">
                <div class="col pb-5">
                    <div class="mt-5">
                        @if ($message = Session::get('success'))
                            <div class="alert p-2 alert-success alert-dismissible fade show" id="message-alert"
                                role="alert">
                                <strong class="redhat med-text">{{ $message }}</strong>
                                <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert p-2 alert-danger alert-dismissible fade show" id="message-alert"
                                role="alert">
                                <strong class="redhat med-text">{{ $message }}</strong>
                                <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert p-2 alert-danger alert-dismissible fade show" id="message-alert"
                                role="alert">
                                <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                @foreach ($errors->all() as $error)
                                <strong class="redhat med-text">{{ $error }}</strong><br>
                                @endforeach
                            </div>
                        @endif
                        <span class="pt-3 redhat text-muted"><b>Profile</b></span>
                    </div>
                    <div class="bg-white shadow-sm mt-3 p-3">
                        <div class="ps-3 pt-3">
                            <h5 class="redhat text-purple spacing-1"><b>General Information</b></h5>
                        </div>
                        <div class="ps-3">
                            @csrf
                            @foreach ($data as $row)
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col flex-column bd-highlight">
                                                <div>
                                                    <span class="redhat small-text text-muted">FIRST
                                                        NAME</span>
                                                </div>
                                                <div>
                                                    <span class="redhat med-text"><b>{{ $row->firstname }}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col flex-column bd-highlight">
                                                <div>
                                                    <span class="redhat small-text text-muted">MIDDLE
                                                        NAME</span>
                                                </div>
                                                <div>
                                                    <span class="redhat med-text"><b>{{ $row->middlename }}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col flex-column bd-highlight">
                                                <div>
                                                    <span class="redhat small-text text-muted">LAST
                                                        NAME</span>
                                                </div>
                                                <div>
                                                    <span class="redhat med-text"><b>{{ $row->lastname }}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col flex-column bd-highlight">
                                                <div>
                                                    <span class="redhat small-text text-muted">PHONE
                                                        NUMBER</span>
                                                </div>
                                                <div>
                                                    <span class="redhat med-text"><b>{{ $row->phone_code }}
                                                            {{ $row->phone_number }}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col mt-3">
                                                <button type="button"
                                                    class="btn btn-sm redhat med-text bg-purple text-white me-2"
                                                    data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                                    Change Password
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col flex-column bd-highlight">
                                                <div>
                                                    <span class="redhat small-text text-muted">EMAIL</span>
                                                </div>
                                                <div>
                                                    <span class="redhat med-text"><b>{{ $email }}</b></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
