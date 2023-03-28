@foreach($detail as $row)
<h5 class="redhat text-purple"><b>Log Detail #{{ $row->id }}</b></h5>
<table class="table med-text" id="detail_table">
    <tr>
        <td><b>IP</b></td>
        <td>:</td>
        <td>{{ $row->ip }}</td>
    </tr>
    <tr>
        <td><b>URL</b></td>
        <td>:</td>
        <td>{{ $row->url }}</td>
    </tr>
    <tr>
        <td><b>Log</b></td>
        <td>:</td>
        <td>{{ $row->log }}</td>
    </tr>
    <tr>
        <td><b>Data ID</b></td>
        <td>:</td>
        <td>{{ $row->data_id }}</td>
    </tr>
    <tr>
        <td><b>File Name</b></td>
        <td>:</td>
        <td>{{ $row->file_name }}</td>
    </tr>
    <tr>
        <td><b>File Patd</b></td>
        <td>:</td>
        <td>{{ $row->file_path }}</td>
    </tr>
    <tr>
        <td><b>Latitude</b></td>
        <td>:</td>
        <td>{{ $row->latitude }}</td>
    </tr>
    <tr>
        <td><b>Longitude</b></td>
        <td>:</td>
        <td>{{ $row->longitude }}</td>
    </tr>
    <tr>
        <td><b>User Input</b></td>
        <td>:</td>
        <td>{{ $row->user_id }}</td>
    </tr>
    <tr>
        <td><b>Created At</b></td>
        <td>:</td>
        <td>{{ $row->created_at }}</td>
    </tr>
</table>
@endforeach
