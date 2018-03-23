@extends('layouts.app')

@section('container')
    <div class="prev_link"><a href="/user/account/device/{{ $packet->device_id }}" ><i style="color:black" class="fas fa-arrow-left"></i> </a></div>
    <table>
        <tr>
            <td><span class="orange">Layer: </span> {{ $packet->log_layers }}</td>
            <td><span class="orange">Type:</span> {{ $packet->log_type }}</td>
            <td><span class="orange">IP source:</span> {{ $packet->log_src }}</td>
            <td><span class="orange">IP destination:</span> {{ $packet->log_dest }}</td>
        </tr>
    </table>
    <hr>
    <pre>{{ $packet->log_requestdump }}</pre>



@endsection