<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('season_id')->unsigned();            
            $table->integer('episode_nr');
            $table->string('title');
            $table->text('plot');
            $table->integer('playtime');
            $table->string('poster');
            $table->string('backdrop');
            $table->date('releasedate');
            $table->integer('imdb_rating')->nullable();
            $table->integer('chas_rating')->nullable();
            $table->timestamps();
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('season_id')->references('id')->on('seasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
