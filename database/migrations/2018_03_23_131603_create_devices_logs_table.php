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
            $table->increments('log_id')->nullable();
            $table->text('log_device')->nullable();
            $table->text('log_layers')->nullable();
            $table->text('log_type')->nullable();
            $table->text('log_host')->nullable();
            $table->text('log_url')->nullable();
            $table->text('log_method')->nullable();
            $table->text('log_form')->nullable();
            $table->text('log_cookie')->nullable();
            $table->text('log_headers')->nullable();
            $table->longText('log_requestdump')->nullable();
            $table->text('log_src')->nullable();
            $table->text('log_dest')->nullable();
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
