@extends('layouts.main')

@section('content')
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
                        <span class="pt-3 redhat text-muted"><b>Log Management</b></span>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex">
                            <button class="btn redhat med-text bg-purple text-white me-2" onclick="exportData('{{ route('export_pdf_log') }}')"><b>Export PDF</b></button>
                            <button class="btn redhat med-text bg-purple text-white me-2" onclick="exportData('{{ route('export_excel_log') }}')"><b>Export Excel</b></button>
                        </div>
                    </div>
                    <div class="bg-white shadow-sm mt-3 p-3">
                        <table class="table med-text" id="log_management_table">
                            <thead class="text-purple">
                                <th>#</th>
                                <th>IP</th>
                                <th>Log</th>
                                <th>Data ID</th>
                                <th>User Input</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="text-muted">
                                @foreach ($log as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->ip }}</td>
                                        <td>{{ $row->log }}</td>
                                        <td>{{ $row->data_id }}</td>
                                        <td>{{ $row->user_id }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-sm bg-purple redhat med-text text-white" onclick="showDetail('log_management/detail/' + {{ $row->id }})">
                                                <b>Detail</b>
                                            </button>
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
