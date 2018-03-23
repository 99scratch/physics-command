@extends('layouts.app')

@section('container')
    <table>
        <tr>
            <th>online Or not</th>
            <th><i class="fas fa-battery-three-quarters"></i></th>
            <th>internet protocol address</th>
            <th>environment</th>
            <th>events</th>
            <th>packets</th>
            <th>execute</th>
            @if(count($devices) < 1)
                <tr>
                    <td>No device found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                @foreach($devices as $device)
                    <tr>
                        <td>@if($device->device_online == "1") <i class="fas fa-wifi" style="color: green;"></i> @else <i class="fas fa-wifi" style="color: red;"></i> @endif</td>
                        <td>{{ round($device->device_power, 2) }} % </td>
                        <td>@if($device->device_name == "::1") localhost @else {{ $device->device_name }} @endif</td>
                        <td><a href="{{ url('/user/account/device/information') }}/{{ $device->device_id }}"><i class="fas fa-info"></i></a></td>
                        <td><a href="{{ url('/user/account/stream/event') }}/{{ $device->device_id }}"><i class="fas fa-bullhorn"></i></a> </td>
                        <td><a href="{{ url('/user/account/device') }}/{{ $device->device_id }}"><i class="fas fa-search-plus"></i> </a> </td>
                        <td><a href="{{ url('/user/account/device') }}/{{ $device->device_id }}/execute"><i class="fas fa-arrow-right"></i> </a> </td>
                    </tr>
                @endforeach
            @endif
    </table>
@endsection