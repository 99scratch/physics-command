@extends('layouts.app')

@section('container')
    <div class="titlediv">Wifi listing</div>

    <table>
        <tr>
            <th>SSID</th>
            <th>Mac</th>
            <th>Authentication</th>
            <th>Encryption</th>
        @if(count($wifis) < 1)
            <tr>
                <td>No wifi found load (physics.wifi.list)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @else
            @foreach($wifis as $wifi)
                @php
                $split = explode("@", $wifi->information_text);
                @endphp
                <tr>
                    <td>@if(isset($split[0])) {{ $split[0] }} @else no SSID @endif</td>
                    <td>@if(isset($split[1])) {{ $split[1] }} @else no mac @endif</td>
                    <td>@if(isset($split[2])) {{ $split[2] }} @else no authentication @endif</td>
                    <td>@if(isset($split[3])) {{ $split[3] }} @else no encryption @endif</td>
                </tr>
            @endforeach
        @endif
    </table>

    <div class="titlediv">Network environnement</div>
    <table>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
        @if(count($environments) < 1)
            <tr>
                <td>No environnement element  (physics.get.env)</td>
                <td></td>
            </tr>
        @else
            @foreach($environments as $environment)
                @php
                $split = explode('&', $environment->information_text);
                @endphp
                <tr>
                    <td>@if(isset($split[0])) {{ $split[0] }} @else Error no element found. @endif</td>
                    <td>@if(isset($split[1])) {{ $split[1] }} @else Error no element found. @endif</td>
                </tr>
            @endforeach
        @endif
    </table>
    <div class="titlediv">BLE environnement</div>
    <table>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
        @if(count($ble) < 1)
            <tr>
                <td>No BLE environnement  (physics.ble.start)</td>
                <td></td>
            </tr>
        @else
            @foreach($ble as $devise)
                @php
                    $split = explode('&', $devise->information_text);
                @endphp
                <tr>
                    <td>@if(isset($split[0])) {{ $split[0] }} @else Error no element found. @endif</td>
                    <td>@if(isset($split[1])) {{ $split[1] }} @else Error no element found. @endif</td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection