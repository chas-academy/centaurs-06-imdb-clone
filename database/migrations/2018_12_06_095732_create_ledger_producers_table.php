<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_producers', function (Blueprint $table) {
            $table->integer('producer_id')->unsigned();
            $table->integer('movie_id')->unsigned()->nullable();
            $table->integer('episode_id')->unsigned()->nullable();
        });
        
        Schema::table('ledger_producers', function (Blueprint $table) {
            $table->foreign('producer_id')->references('id')->on('producers');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('episode_id')->references('id')->on('episodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_producers');
    }
}
