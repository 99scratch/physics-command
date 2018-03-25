<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Devices;
use App\Model\DevicesLogs;
use App\Model\Commands;
use App\Model\DevicesInformation;

class DevicesController extends Controller
{
    protected $commandLists = [
        [
            "command" => "physics.pcap.read",
            "information" => "Read packets from a backdoor network."
        ],
        [
            "command" => "physics.pcap.filter",
            "information" => "Set packet filter e.g: physics.pcap.filter 'tcp port 80'"
        ],
        [
            "command" => "physics.wifi.list",
            "information" => "Send wifi list to event stream tab."
        ],
        [
            "command" => "physics.get.env",
            "information" => "Get information of hardware environment."
        ],
        [
            "command" => "physics.ble.start",
            "information" => "Get information of BLE environment."
        ]
    ];

    public function command_exist($command_text) {

        foreach ($this->commandLists as $commandList){

            if($commandList['command'] == $command_text)
                return true;
            else if(stristr($command_text, $commandList['command']))
                return true;
        }
        return false;
    }

    public function device_view($device_id) {

        $device = Devices::where('device_id', $device_id)
            ->first();

        if(!$device) {

            $this->insertMessage("red", "Can't find this device.");
            return redirect('/user/account/devices');
        }

        $logs = DevicesLogs::where('log_device', $device->device_name)->orderBy('log_id', 'DESC')->paginate(20);

        return view('user.device_view')
            ->with('device', $device)
            ->with('logs', $logs);
    }



    public function view_packet($packet_id) {

        $packet = DevicesLogs::where('log_id', $packet_id)->
        join('devices', 'devices_logs.log_device', '=', 'devices.device_name')->first();
        if($packet) {

            return view('user.packet_view')
                ->with('packet', $packet);
        }

        $this->insertMessage("red", "This packet has been not found.");
        return redirect('/user/account/devices');
    }

    public function device_execute($device_id) {

        $device = Devices::where('device_id', $device_id)
            ->first();

        if(!$device) {

            $this->insertMessage("red", "Can't find this device.");
            return redirect('/user/account/devices');
        }

        $deviceCommands = Commands::where('command_device', $device->device_name)
            ->orderBy('command_id', 'DESC')->paginate(10);

        return view('user.device_run')
            ->with('device', $device)
            ->with('commands', $deviceCommands);
    }

    public function device_execute_post($device_id, Request $data) {

        $device = Devices::where('device_id', $device_id)
            ->first();

        if(!$device) {

            $this->insertMessage("red", "Can't find this device.");
            return redirect('/user/account/devices');
        }

        if($this->command_exist($data->device_command)){

            $new_command = new Commands();
            $new_command->command_device = $device->device_name;
            $new_command->command_text = $data->device_command;
            $new_command->command_exec = '0';
            $new_command->save();

            $this->insertMessage("green", "This command has been inserted.");
            return redirect('/user/account/device/'.$device->device_id.'/execute');

        } else {
            $this->insertMessage("red", "This command has been not found.");
            return redirect('/user/account/device/'.$device->device_id.'/execute');
        }
    }

    public function command_lists() {

        return view('user.command_list')
            ->with('commands', $this->commandLists);
    }

    public function device_information($device_id){

        $device = Devices::where('device_id', $device_id)
            ->first();

        if(!$device) {

            $this->insertMessage("red", "Can't find this device.");
            return redirect('/user/account/devices');
        }

        $deviceWifi = DevicesInformation::where('information_device_id', $device->device_id)
            ->where('information_type', 'wifi')
            ->get();

        $variableEnv = DevicesInformation::where('information_device_id', $device->device_id)
            ->where('information_type', 'environment')
            ->get();

        $deviceBle = DevicesInformation::where('information_device_id', $device->device_id)
            ->where('information_type' , 'BLE')
            ->get();

        return view('user.device_information')
            ->with('environments', $variableEnv)
            ->with('wifis', $deviceWifi)
            ->with('ble', $deviceBle);
    }
}
