<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDdevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddevices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sensor')->nullable();
            $table->string('value1')->nullable();
            $table->string('value2')->nullable();
            $table->string('value3')->nullable();
            $table->string('value4')->nullable();
            $table->string('value5')->nullable();
            $table->string('value6')->nullable();
            $table->string('value7')->nullable();
            $table->string('value8')->nullable();
            $table->string('value9')->nullable();
            $table->string('value10')->nullable();
            $table->string('value11')->nullable();
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
        Schema::dropIfExists('ddevices');
    }
}
