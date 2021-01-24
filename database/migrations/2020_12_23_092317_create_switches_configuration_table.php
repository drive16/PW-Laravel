<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwitchesConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switches_configuration', function (Blueprint $table) {
            $table->string('hostname', 32);
            $table->string('username', 32);
            $table->string('password', 32);
            $table->string('domainName', 32);
            $table->enum('interface', ['Vlan 1']);
            $table->ipAddress('ipAddress');
            $table->string('subnetMask', 15);
            $table->ipAddress('gateway');
            $table->string('deviceID');
            $table->increments('id');
            
            $table->foreign('deviceID')->references('serialNumber')->on('switches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switches_configuration');
    }
}
