<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class physicsAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'physics:createUser {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create physics root users.';

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
        if($this->argument('username') && $this->argument('password'))
        {
            $user = new User();
            $user->user_login = $this->argument("username");
            $user->user_password = md5($this->argument("password"));
            $user->account_header = "";
            $user->save();
            echo "User account has been created.";
        } else {

            echo "Please add argument php physics:createUser {username} {password}";
        }
    }
}
