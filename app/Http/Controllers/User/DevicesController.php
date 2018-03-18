<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Devices;
use App\Model\DevicesLogs;

class DevicesController extends Controller
{
    public function device_view($device_id) {

        $device = Devices::where('device_id', $device_id)
            ->first();

        if(!$device) {

            $this->insertMessage("red", "Can't find this device.");
            return redirect('/user/account/devices');
        }

        $logs = DevicesLogs::where('log_device', $device->device_name)->get();

        return view('user.device_view')
            ->with('logs', $logs);
    }
}
