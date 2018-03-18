@extends('layouts.app')

@section('container')
    <form action="" method="post">
        <label>Send command</label>
        <input type="text" name="device_command" placeholder="e.g: read.pcap" />
        <small>Check command lists <a href="">here</a> </small>
    </form>
    <hr />
    @if(count($logs) > 0)
        <p>Total intercepts ({{ count($logs) }})</p>
    @else
        <p>Total intercept (0)</p>
    @endif
    <table>
        <tr>
            <th>Layers</th>
            <th>Host</th>
            <th>URI</th>
            <th>Method</th>
            <th>Created at</th>
            <th></th>
        @if(count($logs) < 1)
            <tr>
                <td>No logs found</td>
            </tr>
        @else
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->log_layers }}</td>
                    <td>{{ $log->log_host }}</td>
                    <td>{{ $log->log_url }}</td>
                    <td>{{ strtoupper($log->log_method) }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td><a href="{{ url('/user/account/device') }}"><i class="fas fa-search-plus"></i> </a> </td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection