@extends('layouts.app')

@section('container')
    <div class="prev_link"><a href="{{ url('/user/account/devices') }}" ><i style="color:black" class="fas fa-arrow-left"></i> </a></div>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @else
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->log_layers }}</td>
                    <td>{{ $log->log_host }}</td>
                    <td>{{ substr($log->log_url, 0, 40) }}...</td>
                    <td>{{ strtoupper($log->log_method) }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td><a href="{{ url('/user/account/device/packet') }}/{{ $log->log_id }}"><i class="fas fa-search-plus"></i> </a> </td>
                </tr>
            @endforeach
        @endif
    </table>
    {{ $logs->links() }}
@endsection