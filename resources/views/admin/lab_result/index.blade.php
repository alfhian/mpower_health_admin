@extends('layouts.main')

@section('content')
    <div class="modal fade" id="uploadLabResultModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="redhat text-purple text-center mb-3"><b>Upload Recommendation Report</b></h5>
                    <form method="POST" action="{{ route('upload_recommendation') }}" id="upload-lab-report-form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="lab-result-id" name="lab_result_id">
                        <div class="d-flex justify-content-center mt-2">
                            <div>
                                <div class="mb-2 text-start">
                                    <label for="lab-result-no" class="form-label redhat small-text text-purple"
                                        style="margin-left: 10px;"><b>Lab Result No.</b></label>
                                    <input type="text" class="form-control form-control-sm input-gray"
                                        style="margin-top: -15px;" id="lab-result-no" name="lab_result_no" required
                                        readonly>
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="ticket-no" class="form-label redhat small-text text-purple"
                                        style="margin-left: 10px;"><b>Ticket No.</b></label>
                                    <input type="text" class="form-control form-control-sm input-gray" id="ticket-no"
                                        name="ticket-no" style="margin-top: -15px;" required readonly>
                                </div>
                                <div class="mb-3">
                                    <input type="file" class="form-control form-control-sm w-75" name="lab_report"
                                        id="lab-report" required>
                                </div>
                                <div>
                                    <button
                                        class="btn btn-sm w-100 bg-purple redhat med-text text-white shadow spacing-1"><b>Upload</b></button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        @if ($errors->any())
                            <div class="alert p-2 alert-danger alert-dismissible fade show" id="message-alert"
                                role="alert">
                                @foreach ($errors->all() as $error)
                                    <strong class="redhat med-text">{{ $error }}</strong><br>
                                @endforeach
                                <button type="button" class="btn-close small-text" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <span class="pt-3 redhat text-muted"><b>Lab Results</b></span>
                    </div>
                    <div class="bg-white shadow-sm mt-3 p-3">
                        <table class="table med-text" id="lab_results_table">
                            <thead class="text-purple">
                                <th>#</th>
                                <th>Lab Result</th>
                                <th>Client ID/Name</th>
                                <th>Date</th>
                                <th>Lab Report</th>
                                <th>Ticket Number</th>
                                <th>Clerk Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="text-muted">
                                @foreach ($lab_result as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                                                <a href="{{ url('lab_result/show_file/' . $row->lab_result) }}"
                                                    target="_blank">#{{ $row->lab_result_no }}</a>
                                            @else
                                                @if ($row->user_claim == Auth::id())
                                                    <a href="{{ url('lab_result/show_file/' . $row->lab_result) }}"
                                                        target="_blank">#{{ $row->lab_result_no }}</a>
                                                @else
                                                    #{{ $row->lab_result_no }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $row->client_id . '/' . $row->firstname . ' ' . $row->lastname }}</td>
                                        <td>{{ $row->upload_date }}</td>
                                        <td>
                                            @if ($row->recommendation_id == null)
                                                -
                                            @else
                                                @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                                                    <a href="{{ url('recommendation/show_file/' . $row->recommendation) }}"
                                                        target="_blank">Recommendation
                                                        link</a>
                                                @else
                                                    @if ($row->admin == Auth::id())
                                                        <a href="{{ url('recommendation/show_file/' . $row->recommendation) }}"
                                                            target="_blank">Recommendation
                                                            link</a>
                                                    @else
                                                        -
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $row->ticket_number }}</td>
                                        <td>
                                            @if ($row->user_claim == null)
                                                -
                                            @else
                                                {{ $row->clerk_firstname . ' ' . $row->clerk_lastname }}
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($row->claim == 'N')
                                                <form action="{{ route('claim_recommendation') }}" method="post"
                                                    id="lab-result-claim-form-{{ $row->id }}">
                                                    @csrf
                                                    <input type="hidden" name="claim" value="{{ $row->id }}">
                                                    <button type="button"
                                                        class="btn btn-sm redhat med-text bg-purple text-white"
                                                        onclick="claimLabResult('lab-result-claim-form-{{ $row->id }}')">
                                                        Claim
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-sm btn-secondary redhat med-text"
                                                    disabled>
                                                    Claim
                                                </button>
                                                @if ($row->user_claim == Auth::id() && $row->recommendation_id == null)
                                                    <button type="button" class="btn btn-default bg-transparent"
                                                        onclick="uploadLabReport('{{ $row->id }}', '{{ $row->lab_result_no }}', '{{ $row->ticket_number }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                            height="12" fill="currentColor" class="bi bi-upload"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                            <path
                                                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
