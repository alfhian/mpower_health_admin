@extends('layouts.main')

@section('content')
    <div class="modal fade" id="uploadLabResultModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="redhat text-purple text-center mb-3"><b>Upload Lab Result</b></h5>
                    <form method="POST" action="{{ url('lab_result/upload_lab_result') }}" id="upload-lab-result-form" enctype="multipart/form-data">
                        @csrf
                        <span class="redhat small-text text-muted">Please upload only <b>1 (one)</b> of the following format for each
                            <b>Lab Result (jpg, png, pdf)</b>.</span>
                        <div class="d-flex justify-content-center mt-2">
                            <input type="file" class="form-control form-control-sm w-75" name="lab_result"
                                id="lab-result" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3 mb-2">
                            <input type="checkbox" class="form-check-input me-2" name="read" id="policy-check">
                            <span class="redhat small-text text-primary">I've read the <span class="text-blue"
                                    style="cursor: pointer" data-bs-toggle="modal"
                                    data-bs-target="#termsModal"><b>Terms and Conditions</b></span>
                                    and <span class="text-blue" style="cursor: pointer" data-bs-toggle="modal"
                                        data-bs-target="#ppModal"><b>Privacy Policy</b></span> and am willing to proceed.</span>
                        </div>
                        <button class="btn btn-sm bg-purple redhat med-text text-white shadow spacing-1 px-5 me-4"><b>UPLOAD
                                FILE</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-container d-flex">
        @include('layouts.sidebar')
        <div class="dashboard container-fluid m-0 px-3 pt-5">
            <div class="row">
                <div class="col-8 pb-5">
                    <div class="mt-5">
                        @if ($message = Session::get('success'))
                            <div class="alert p-2 alert-success alert-dismissible fade show" id="message-alert" role="alert">
                                <strong class="redhat med-text">{{ $message }}</strong>
                                <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <span class="pt-3 redhat med-text text-muted"><b>Profile</b></span>
                    </div>
                    <div class="ps-3 pt-3">
                        <h5 class="redhat text-purple spacing-1"><b>General Information</b></h5>
                    </div>
                    <div class="ps-3">
                        <form action="{{ url('profile_management/edit') }}" method="post" id="profile-management-form">
                            @csrf
                            @foreach ($data as $row)
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <label for="firstname" class="form-label redhat med-text text-muted">First
                                            Name</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="firstname" id="firstname"
                                            class="form-control form-control-sm" value="{{ $row->firstname }}" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        <label for="lastname" class="form-label redhat med-text text-muted">Last
                                            Name</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="lastname" id="lastname"
                                            class="form-control form-control-sm" value="{{ $row->lastname }}" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        <label for="email" class="form-label redhat med-text text-muted">Email</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="email" name="email" id="email"
                                            class="form-control form-control-sm" value="{{ $email }}" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3">
                                        <label for="personal_information"
                                            class="form-label redhat med-text text-muted">Personal
                                            Information</label>
                                    </div>
                                    <div class="col-8">
                                        <textarea name="personal_information" id="personal_information" class="form-control form-control-sm">{{ $row->personal_information }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-8 mt-3 d-flex justify-content-center">
                                    <button type="button" class="btn btn-sm redhat med-text bg-purple text-white me-2" onclick="showOption('profile-management-form', 'update')">
                                        <div class="d-flex justify-content-center align-item-center">
                                            <div class="pe-4" style="margin-top: -3px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                    fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </div>
                                            <div class="pe-4 sato spacing-1">
                                                Change Profile
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row mt-5">
                            <div class="col-3"></div>
                            <div class="col-8 d-flex justify-content-center">
                                <button type="button" class="btn btn-sm bg-green xsmall-text text-white py-2"
                                    data-bs-toggle="modal" data-bs-target="#uploadLabResultModal">
                                    <div class="d-flex justify-content-center align-item-center">
                                        <div class="pe-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </div>
                                        <div class="pe-4 sato spacing-1">
                                            UPLOAD LAB RESULT
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
