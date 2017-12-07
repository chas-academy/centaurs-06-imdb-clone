<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use DB;

class Movie extends Model
{
    public function createMovie($properties) 
    {
        // $faker = Faker::create();
        // var_dump($properties['results'][0]);
        // die;
        DB::table('movies')->insert([
            'title' => $properties['results'][0]['title'],
            'plot' => $properties['results'][0]['overview'],
            'playtime' => 55,
            'poster' => $properties['results'][0]['poster_path'],
            'backdrop' => $properties['results'][0]['backdrop_path'],
            'releasedate' => $properties['results'][0]['release_date'],
            'imdb_rating' => $properties['results'][0]['vote_average'],
            'chas_rating' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
