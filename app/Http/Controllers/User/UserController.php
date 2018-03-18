<?php

namespace App\Http\Controllers\User;

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
}
