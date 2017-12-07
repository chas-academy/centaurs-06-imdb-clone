<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_api_id')->nullable();
            $table->string('title');
            $table->text('plot');
            $table->integer('playtime');
            $table->string('poster');
            $table->string('backdrop');
            $table->date('releasedate');
            $table->integer('imdb_rating');
            $table->integer('chas_rating');
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
        Schema::dropIfExists('movies');
    }
}
