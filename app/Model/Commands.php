<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commands extends Model
{
    protected $primaryKey = 'command_id';
    protected $table = 'commands';
}
