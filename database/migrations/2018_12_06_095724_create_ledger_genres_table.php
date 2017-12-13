<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_genres', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned();
            $table->integer('movie_id')->unsigned()->nullable();
            $table->integer('episode_id')->unsigned()->nullable();
        });
        
        Schema::table('ledger_genres', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('genre_id')->references('id')->on('genres');
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
        Schema::dropIfExists('movie_genres');
    }
}
