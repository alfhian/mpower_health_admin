<h4><b>Log Management Report</b></h4>
<table style="margin-bottom: 3rem; font-size: 13px;">
    <tr>
        <td>Start Date</td>
        <td>:</td>
        <td>{{ $start_date }}</td>
    </tr>
    <tr>
        <td>End Date</td>
        <td>:</td>
        <td>{{ $end_date }}</td>
    </tr>
</table>
<table style="border-spacing: 0; font-size: 13px;" id="export-table">
    <thead>
        <th style="border: solid 1px black">ID</th>
        <th style="border: solid 1px black">IP</th>
        <th style="border: solid 1px black">URL</th>
        <th style="border: solid 1px black">Log</th>
        <th style="border: solid 1px black">Data ID</th>
        <th style="border: solid 1px black">User Input</th>
        <th style="border: solid 1px black">Created At</th>
    </thead>
    @foreach($log as $row)
    <tbody style="border: solid 1px black">
        <tr>
            <td align="center" style="padding: 0px 5px; border: solid 1px black">{{ $row->id }}</td>
            <td style="padding: 0px 5px; border: solid 1px black">{{ $row->ip }}</td>
            <td style="padding: 0px 5px; border: solid 1px black">{{ $row->url }}</td>
            <td style="padding: 0px 5px; border: solid 1px black">{{ $row->log }}</td>
            <td style="padding: 0px 5px; border: solid 1px black">{{ $row->data_id }}</td>
            <td style="padding: 0px 5px; border: solid 1px black">{{ $row->user_id }}</td>
            <td style="padding: 0px 5px; border: solid 1px black">{{ $row->created_at }}</td>
        </tr>
    </tbody>
    @endforeach
</table>