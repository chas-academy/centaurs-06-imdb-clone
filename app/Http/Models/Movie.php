<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use DB;

class Movie extends Model
{
    public function createMovie($properties) 
    {
        DB::table('movies')->insert([
            'movie_api_id' => $properties['results'][0]['id'],
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

        $movie = $this->getMovie($properties['results'][0]['title']);
        $genres = $this->getGenres($properties['results'][0]['genre_ids']);

        foreach ($genres as $genre) {

            DB::table('ledger_genres')->insert([
                'movie_id' => $movie->id,
                'genre_id' => $genre->id
            ]);
        }
    }

    public function createMovieStaff($properties) 
    {
        for ($i=0; $i < 5; $i++) { 
            DB::table('actors')->insert([
                'movie_api_id' => $properties['id'],
                'name' => $properties['cast'][$i]['name']
                ]);
            }

            foreach ($properties['crew'] as $crewMember) {
                if ($crewMember['job'] === 'Director') {
                    DB::table('directors')->insert([
                        'movie_api_id' => $properties['id'],
                        'name' => $crewMember['name']
                        ]);
                } 
                if ($crewMember['job'] === 'Producer') {
                    DB::table('producers')->insert([
                        'movie_api_id' => $properties['id'],
                        'name' => $crewMember['name']
                        ]);    
                }
            }            
    }

    public function createMovieGenres($properties) 
    {
        foreach ($properties['genres'] as $genre) {
            DB::table('genres')->insert([
                'genre_name' => $genre['name'],
                'api_genre_id' => $genre['id']
            ]);
        }             
    }

    public function getMovie($movieTitle) 
    {
        $movie = DB::table('movies')->get()->where('title', $movieTitle);

        return array_first($movie);
    }

    public function getGenres($genreId)
    {
        $genres = [];

        foreach ($genreId as $id) {
            array_push($genres , DB::table('genres')->get()->where('api_genre_id', $id)->first());
        }
            
        return $genres;
    }
}
