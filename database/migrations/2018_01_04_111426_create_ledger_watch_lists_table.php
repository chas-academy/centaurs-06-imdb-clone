<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgerWatchListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_watch_lists', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('movie_id')->unsigned()->nullable();
            $table->integer('tvshow_id')->unsigned()->nullable();
        });
        
        Schema::table('ledger_watch_lists', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('tvshow_id')->references('id')->on('tv_shows');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledger_watch_lists');
    }
}
