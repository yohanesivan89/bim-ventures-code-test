<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d__transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trx_id');
            $table->foreign('trx_id')->references('id')->on('transactions'); 
            $table->float('amount', 12, 2);
            $table->string('desc')->nullable();
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
        Schema::dropIfExists('d__transactions');
    }
}
