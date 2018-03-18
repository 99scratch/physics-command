<?php

namespace App\Console\Commands\Devices;

use Illuminate\Console\Command;
use App\Model\Devices;

class CheckOffline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'physics:devices_off';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set offline all devices.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $devices = Devices::all();
        if(count($devices) > 0) {

            foreach ($devices as $device) {

                $device->device_online = 0;
                $device->save();
            }
        }
    }
}
