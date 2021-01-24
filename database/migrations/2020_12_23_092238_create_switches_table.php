<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switches', function (Blueprint $table) {
            $table->string('name', 32);
            $table->enum('model', ['C2960-X','C2960-S']);
            $table->set('type', ['Switches']);
            $table->string('firmware', 20);
            $table->enum('ports', ['24','48']);
            $table->string('serialNumber', 11)->primary();
            $table->integer('userID')->unsigned();
        });

        Schema::table('switches', function (Blueprint $table) {
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
        Schema::dropIfExists('switches');
    }
}
