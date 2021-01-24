<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration', function (Blueprint $table) {
            $table->string('hostname', 32);
            $table->string('username', 32);
            $table->string('password', 32);
            $table->string('domainName', 32);
            $table->enum('interface', ['GigabitEthernet0/0/0','GigabitEthernet0/0/1','GigabitEthernet0/0/2','GigabitEthernet0/0','GigabitEthernet0/1','GigabitEthernet0/2']);
            $table->ipAddress('ipAddress');
            $table->string('subnetMask', 15);
            $table->ipAddress('gateway');
            $table->string('deviceID');
            $table->increments('id');
            
            $table->foreign('deviceID')->references('serialNumber')->on('router');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration');
    }
}
