<?php

namespace App\Http\Controllers\User;

use App\Model\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Support\Facades\Session;
use App\Model\Devices;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login() {

        return view('user.login');
    }

    public function login_post(Request $data) {

        $select_user = User::where('user_login', $data->username)
            ->where('user_password', md5($data->password))
            ->first();

        if(!$select_user) {

            $this->insertMessage('red', "User not found.");
            return redirect()->back();
        }

        Session::push('user', $select_user);
        return redirect('/user/account/devices');
    }

    public function account_view() {

        $devices = Devices::all();
        return view('user.account_view')
            ->with('devices', $devices);
    }

    public function logout(){

        Session::forget('user');
        return redirect('/user/account/devices');
    }

    public function stream_event($device_id) {
        $device = Devices::where('device_id', $device_id)
            ->first();

        if(!$device) {

            $this->insertMessage("red", "Can't find this device.");
            return redirect('/user/account/devices');
        }

        $events = Events::where("event_device", $device->device_name)->orderBy('event_id', 'DESC')
            ->paginate(8);
        return view('user.stream_event')
            ->with('events', $events);
    }

    public function stream_global() {

        $events = Events::orderBy('event_id', 'DESC')
            ->paginate(8);
        return view('user.stream_global')
            ->with('events', $events);
    }

    public function account_settings() {

        $settings = User::first();
        return view('user.account_settings')
            ->with('settings', $settings);
    }

    public function account_settings_update(Request $data) {

        $update = User::first();
        $updated = 0;
        if(isset($data->account_header) && !empty($data->account_header)){

            $update->account_header = $data->account_header;
            $updated = 1;
        }
        if(isset($data->user_password_new, $data->user_password) && !empty($data->user_password_new) && !empty($data->user_password)) {

            $current_passsword = md5($data->user_password);
            if($current_passsword == $update->user_password) {

                $new_password = md5($data->user_password_new);
                $update->user_password = $new_password;
                $updated = 1;
            } else {

                $this->insertMessage("red", "Current password not same.");
                return redirect('/user/account/settings');
            }
        }
        if($updated = 1) {
            $update->save();
        }

        $this->insertMessage("green","Account has been updated");
        return redirect('/user/account/settings');
    }
}
