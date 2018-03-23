<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices_logs', function (Blueprint $table) {
            $table->increments('log_id');
            $table->text('log_device');
            $table->text('log_layers');
            $table->text('log_type');
            $table->text('log_host');
            $table->text('log_url');
            $table->text('log_method');
            $table->text('log_form');
            $table->text('log_cookie');
            $table->text('log_headers');
            $table->longText('log_requestdump');
            $table->text('log_src');
            $table->text('log_dest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
