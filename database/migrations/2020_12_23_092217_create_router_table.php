<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('router', function (Blueprint $table) {
            $table->string('name', 32);
            $table->enum('model', ['Cisco 2911','Cisco 4331']);
            $table->set('type', ['Router']);
            $table->string('firmware', 20);
            $table->integer('ports');
            $table->string('serialNumber', 11)->primary();
            $table->integer('userID')->unsigned();
        });
        
        Schema::table('router', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('router');
    }
}
