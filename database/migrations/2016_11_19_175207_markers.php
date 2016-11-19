<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Markers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markers', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->double('lat');
            $table->double('lng');
            $table->string('inner_title');
            $table->string('icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('markers');
    }
}
