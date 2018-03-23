<?php

namespace App\Http\Controllers\Api;

use App\Model\DevicesInformation;
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
            $select_devices = new Devices();
            $select_devices->device_name = $_SERVER['REMOTE_ADDR'];
            $select_devices->device_power = '0';
            $select_devices->device_online = '1';
            $select_devices->device_address = $_SERVER['REMOTE_ADDR'];
            $select_devices->save();
         }


        if($data->insertType == "sendBattery" && isset($data->data["batteryLevel"])) {

           $select_devices->device_power = $data->data["batteryLevel"];
           $select_devices->save();

        } else if($data->insertType == "sendLogs" && isset($data->data["log_src"])) {

                $log = new DevicesLogs();
                $log->log_device = $device_name;
                $log->log_layers = $data->data["log_layers"];
                $log->log_type = $data->data["log_type"];
                $log->log_host   = $data->data["log_host"];
                $log->log_url    = $data->data["log_url"];
                $log->log_method = $data->data["log_method"];
                $log->log_form   = $data->data["log_form"];
                $log->log_cookie = $data->data["log_cookie"];
                $log->log_headers= $data->data["log_headers"];
                $log->log_src    = $data->data["log_src"];
                $log->log_dest   = $data->data["log_dest"];
                $log->log_requestdump = $data->data["log_requestdump"];
                $log->save();

        } else if($data->insertType == "sendEvent" && isset($data->data['event_title'])){

            $this->insertEvent($select_devices->device_name, $data->data['event_title'], $data->data['event_body']);
        } else if($data->insertType == "sendWifi" && isset($data->data['wifiJson'])) {

            $list = json_decode($data->data['wifiJson'], true);
            $select_wifi = DevicesInformation::where('information_device_id', $select_devices->device_id)->where('information_type', "wifi")
                ->get();
            if(count($select_wifi) > 0) {
                foreach ($select_wifi as $wifistation)
                    $wifistation->delete();
            }

            if(isset($list['aps'])){
                foreach ($list['aps'] as $wifi){

                    $tpl = $wifi['hostname']."@".$wifi['mac']."@".$wifi['authentication']."@".$wifi['encryption'];
                    $log = new DevicesInformation();
                    $log->information_device_id = $select_devices->device_id;
                    $log->information_type = "wifi";
                    $log->information_text = $tpl;
                    $log->save();
                }
            }
        } else if($data->insertType == "sendEnvironment" && isset($data->data['Environment'])) {
            $select_env = DevicesInformation::where('information_device_id', $select_devices->device_id)->where('information_type', "environment")
                ->get();
            if(count($select_env) > 0) {
                foreach ($select_env as $env)
                    $env->delete();
            }

            $json = json_decode($data->data['Environment'], true);
            $gateway_address = $json["data"]['gateway.address'];
            $gateway_mac     = $json["data"]['gateway.mac'];
            $ipv4_address    = $json["data"]['iface.ipv4'];

            $log = new DevicesInformation();
            $log->information_device_id = $select_devices->device_id;
            $log->information_type = "environment";
            $log->information_text = "gateway address&".$gateway_address;
            $log->save();

            $log = new DevicesInformation();
            $log->information_device_id = $select_devices->device_id;
            $log->information_type = "environment";
            $log->information_text = "gateway mac&".$gateway_mac;
            $log->save();

            $log = new DevicesInformation();
            $log->information_device_id = $select_devices->device_id;
            $log->information_type = "environment";
            $log->information_text = "iface ipv4&".$ipv4_address;
            $log->save();

        }
    }
}
