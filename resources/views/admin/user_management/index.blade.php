@extends('layouts.main')
@section('content')
    <div class="dashboard-container d-flex">
        @include('layouts.sidebar')
        <div class="modal fade" id="addUserModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content py-4">
                    <div class="modal-body text-center">
                        <h5 class="redhat text-purple text-center mb-3"><b>Add New User</b></h5>
                        <form method="POST" action="{{ route('add_user') }}" id="add-user-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="w-100 mt-2 px-4">
                                <div>
                                    <div class="mb-2 text-start">
                                        <label for="email" class="form-label redhat small-text text-purple"
                                            ><b>Email</b></label>
                                        <input type="text" class="form-control form-control-sm input-gray"
                                            id="email" name="email" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="firstname" class="form-label redhat small-text text-purple"
                                            ><b>First Name</b></label>
                                        <input type="text" class="form-control form-control-sm input-gray" id="firstname"
                                            name="firstname" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="middlename" class="form-label redhat small-text text-purple"
                                            ><b>Middle Name</b></label>
                                        <input type="text" class="form-control form-control-sm input-gray"
                                            id="middlename" name="middlename">
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="lastname" class="form-label redhat small-text text-purple"
                                            ><b>Last Name</b></label>
                                        <input type="text" class="form-control form-control-sm input-gray" id="lastname"
                                            name="lastname" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="position" class="form-label redhat small-text text-purple"
                                            ><b>Position</b></label>
                                        <input type="text" class="form-control form-control-sm input-gray" id="position"
                                            name="position" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="role" class="form-label redhat small-text text-purple"
                                            ><b>Role</b></label>
                                        <select name="role" id="role"
                                            class="form-control form-control-sm select input-gray"
                                            required>
                                            @foreach ($roles as $data)
                                                <option value="{{ $data->id }}">{{ $data->role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-sm w-100 mt-2 bg-purple redhat med-text text-white shadow spacing-1"><b>Save</b></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="resetPasswordModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-4">
                <div class="modal-body text-center">
                    <h5 class="redhat text-purple text-center mb-3"><b>Reset Password</b></h5>
                    <form method="POST" action="{{ route('admin_reset_password') }}" id="reset-user-password-form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="reset_id" name="reset_id">
                        <div class="w-100 mt-2 px-4">
                            <div>
                                <div class="mb-2 text-start">
                                    <label for="user_name"
                                        class="form-label redhat small-text text-purple"><b>Name</b></label>
                                    <input type="text" class="form-control form-control-sm input-gray" id="user_name"
                                        name="user_name" required readonly>
                                </div>
                                <div class="mb-2 text-start">
                                    <label for="user_email"
                                        class="form-label redhat small-text text-purple"><b>Email</b></label>
                                    <input type="text" class="form-control form-control-sm input-gray" id="user_email"
                                        name="user_email" required readonly>
                                </div>
                                <div class="mb-2 text-start">
                                    <label for="password"
                                        class="form-label redhat small-text text-purple"><b>Password</b></label>
                                    <div class="d-flex align-items-center">
                                        <div class="input-group pe-2">
                                            <input id="password" class="form-control form-control-sm input-gray"
                                                type="password" name="password" required autocomplete="new-password" />
                                            <button class="btn btn-sm input-gray" type="button" id="button-visible1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <button type="button" class="px-1 py-0 bg-transparent border-0" id="psw-tooltip"
                                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="manual"
                                            data-bs-html="true"
                                            data-bs-title="<b></b>Password must:<ul><li>Be a minimun 8 characters</li><li>Include at least one lowercase letter (a-z)</li><li>Include at least one uppercase letter (A-Z)</li><li>Include at least one number (0-9)</li><li>Include at least one special character</li></ul>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-question-circle-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('email')
                                        <div class="redhat text-danger small-text mt-1 spacing-1">
                                            <span>{{ json_decode($errors)->email[0] }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <button
                                    class="btn btn-sm w-100 mt-2 bg-purple redhat med-text text-white shadow spacing-1"><b>Save</b></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

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
                        <span class="pt-3 redhat text-muted"><b>User Management</b></span>
                    </div>
                    <div class="bg-white shadow-sm mt-3 p-3">
                        @if (Auth::user()->role_id == 4)
                            <button type="button" class="btn btn-sm bg-blue med-text text-white me-2 py-2"
                                data-bs-toggle="modal" data-bs-target="#addUserModal">Add</button>
                        @endif
                        <table class="table med-text" id="user_management_table">
                            <thead class="text-purple">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>ID</th>
                                <th>Role</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="text-muted">
                                @foreach ($user as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->firstname . ' ' . $row->lastname }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->role }}</td>
                                        <td align="center">
                                            @if ($row->role_id != 1)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <form action="{{ route('user_status') }}"
                                                        id="user-form-{{ $row->id }}" method="post">
                                                        @csrf
                                                        @if ($row->status == 'Y')
                                                            <div class="form-check form-switch">
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $row->id }}">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="{{ $row->id }}"
                                                                    name="status_check" checked>
                                                            </div>
                                                        @else
                                                            <div class="form-check form-switch">
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $row->id }}">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" id="{{ $row->id }}"
                                                                    name="status_check">
                                                            </div>
                                                        @endif
                                                    </form>
                                                    <button type="button"
                                                        class="btn btn-sm bg-purple small-text text-white ms-2 py-2"
                                                        data-bs-toggle="modal" data-bs-target="#resetPasswordModal"
                                                        onclick="addUserID('{{ $row->id }}', '{{ $row->firstname . ' ' . $row->lastname }}', '{{ $row->email }}')">Reset
                                                        Password</button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
