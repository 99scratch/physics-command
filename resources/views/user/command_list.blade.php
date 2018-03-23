@extends('layouts.app')

@section('container')
    <table style="">
        <tr>
            <th>Command</th>
            <th>Resume</th>
        @if(count($commands) < 1)
            <tr>
                <td>No logs found</td>
                <td></td>
            </tr>
        @else
            @foreach($commands as $command)
                <tr style="text-align: left;">
                    <td>{{ $command['command'] }}</td>
                    <td>{{ $command['information'] }}</td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection