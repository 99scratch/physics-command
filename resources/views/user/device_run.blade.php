@extends('layouts.app')

@section('container')
    @if($device->device_online == '1')
        <form action="#" method="post">
            @else
                <form>
                    @endif
                    @if($device->device_online == '1')
                        <label class="label_connect">Send command</label>
                        <input type="text" name="device_command" placeholder="e.g: physics.read.pcap" />
                    @else
                        <label>Device offline or command in progress.</label>
                        <input type="text" name="device_command" readonly="readonly" placeholder="Device offline or command in progress." />
                    @endif
                    {{ csrf_field() }}
                    @if($device->device_online == '1')
                        <input type="submit" class="physics_button" value="execute now" />
                    @else
                        <input type="button" class="physics_button" value="Device offline or command in progress" />
                    @endif
                </form>
                @if(count($commands) > 0)
                    <p>Total command executing ({{ count($commands) }})</p>
                @else
                    <p>Total command executing (0)</p>
                @endif
                <table>
                    <tr>
                        <th>Command</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>Run_at</th>
                    @if(count($commands) < 1)
                        <tr>
                            <td>No old commands found</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach($commands as $command)
                            <tr>
                                <td>{{ $command->command_text }}</td>
                                <td>@if($command->command_exec == "1") <span class="txtgreen">Executed</span> @else <span class="orange">Not executed</span>@endif </td>
                                <td>{{ $command->created_at }}</td>
                                <td>{{ $command->updated_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
@endsection