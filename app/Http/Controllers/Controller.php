<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use App\Model\Events;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function insertMessage($level, $text) {

        Session::flash("message.level", $level);
        Session::flash("message.content", $text);
    }

    public function insertEvent($device, $title, $body = '') {

        if($device != '' && $title != ''){

            $event = new Events();
            $event->event_title = $title;
            $event->event_body = $body;
            $event->event_device = $device;
            $event->save();
            return true;
        }
        return false;
    }
}
