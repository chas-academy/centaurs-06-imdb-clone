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

        $movie = $this->getMovieByTitle($properties['results'][0]['title']);
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
        for ($i=0; $i < 5; $i++) 
        { 

            $movieId = $this->getMovie();

            DB::table('actors')->insert([
                'movie_api_id' => $properties['id'],
                'name' => $properties['cast'][$i]['name']
                ]);

            $actor = $this->getActors($properties['cast'][$i]['name']);
            
            DB::table('ledger_actors')->insert([
                'actor_id' => $actor->id,
                'movie_id' => $movieId->id
                ]);
        }

        foreach ($properties['crew'] as $crewMember) 
        {
            
            $movieId = $this->getMovie();
            
            if ($crewMember['job'] === 'Director') 
            {
                DB::table('directors')->insert([
                    'movie_api_id' => $properties['id'],
                    'name' => $crewMember['name']
                    ]);

                $director = $this->getDirectors($crewMember['name']);
                    
                DB::table('ledger_directors')->insert([
                    'director_id' => $director->id,
                    'movie_id' => $movieId->id
                    ]);
                } 
                    
            if ($crewMember['job'] === 'Producer') 
            {     
                DB::table('producers')->insert([
                    'movie_api_id' => $properties['id'],
                    'name' => $crewMember['name']
                    ]);
                    
                $producer = $this->getProducers($crewMember['name']);

                DB::table('ledger_producers')->insert([
                    'producer_id' => $producer->id,
                    'movie_id' => $movieId->id
                ]);
            }
        }            
    }

    public function createMovieGenres($properties) 
    {
        foreach ($properties['genres'] as $genre) 
        {
            DB::table('genres')->insert([
                'genre_name' => $genre['name'],
                'api_genre_id' => $genre['id']
            ]);
        }             
    }

    public function getMovie() 
    {
        $movie = DB::table('movies')->orderBy('created_at', 'desc')->first();

        return $movie;
    }

    public function getMovieByTitle($movieTitle) 
    {
        $movie = DB::table('movies')->get()->where('title', $movieTitle);

        return array_first($movie);
    }

    public function getProducers($name) 
    {
        $producerName = DB::table('producers')->get()->where('name', $name);
       
        return array_first($producerName);
    }

    public function getDirectors($name)
    {
        $directorName = DB::table('directors')->get()->where('name', $name);

        return array_first($directorName);
    }

    public function getActors($name)
    {
        $actorName = DB::table('actors')->get()->where('name', $name);

        return array_first($actorName);
    }

    public function getGenres($genreId)
    {
        $genres = [];

        foreach ($genreId as $id) {
            array_push($genres , DB::table('genres')->get()->where('api_genre_id', $id)->first());
        }
            
        return $genres;
    }

    public function getAllMovies() 
    {
        $movies = DB::table('movies')->get();

        return $movies;
    }

    public function getMovieById($movieId) 
    {
        $movies = DB::table('movies')->get()->where('id', $movieId);

        return array_first($movies);
    }
}