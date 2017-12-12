<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use DB;

class Movie extends Model
{
    public function createMovie($properties) 
    {
        if(!$this->checkIfMovieExists($properties['results'][0]['title'])) {
            
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
    }

    public function createMovieStaff($properties)
    {        
        for ($i=0; $i < 5; $i++) 
        { 

            $movieId = $this->getMovie();
            if(!$this->checkIfActorExists($movieId->title)) {
                DB::table('actors')->insert([
                    'movie_api_id' => $properties['id'],
                    'name' => $properties['cast'][$i]['name']
                    ]);
            }

            $actor = $this->getActors($properties['cast'][$i]['name']);
            
            DB::table('ledger_actors')->insert([
                'actor_id' => $actor->id,
                'movie_id' => $movieId->id
                ]);
        }

        foreach ($properties['crew'] as $crewMember) 
        {
            
            $movieId = $this->getMovie();
            
            if ($crewMember['job'] === 'Director') {
                
                if($this->checkIfDirectorExists($crewMember['name']))
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

            if ($crewMember['department'] === 'Writing') 
            {     
                DB::table('writers')->insert([
                    'movie_api_id' => $properties['id'],
                    'name' => $crewMember['name']
                    ]);
                    
                $writer = $this->getWriters($crewMember['name']);

                DB::table('ledger_writers')->insert([
                    'writer_id' => $writer->id,
                    'movie_id' => $movieId->id
                ]);
            }
        }            
    }

    public function createMovieGenres($properties) 
    {
        foreach ($properties['genres'] as $genre) 
        {
            if(!DB::table('genres')->where('genre_name', $genre['name'])->exists()){
                    DB::table('genres')->insert([
                        'genre_name' => $genre['name'],
                        'api_genre_id' => $genre['id']
                    ]);
            }
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

    public function getWriters($name)
    {
        $writerName = DB::table('writers')->get()->where('name', $name);

        return array_first($writerName);
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

    public function getMovieActors($movieId)
    {
        $actorIds = DB::table('ledger_actors')->get()->where('movie_id', $movieId);

        $actors = [];

        foreach ($actorIds as $actorId)
        {
            array_push($actors, DB::table('actors')->where('id', $actorId->actor_id)->value('name'));
        }
        
        return $actors;
    }

    public function getMovieDirectors($movieId)
    {
        $directorIds = DB::table('ledger_directors')->get()->where('movie_id', $movieId);

        $directors = [];

        foreach ($directorIds as $directorId)
        {
            array_push($directors, DB::table('directors')->where('id', $directorId->director_id)->value('name'));
        }
        
        return $directors;
    }

    public function getMovieProducers($movieId)
    {
        $producerIds = DB::table('ledger_producers')->get()->where('movie_id', $movieId);

        $producers = [];

        foreach ($producerIds as $producerId)
        {
            array_push($producers, DB::table('producers')->where('id', $producerId->producer_id)->value('name'));
        }
        
        return $producers;
    }

    public function getMovieWriters($movieId)
    {
        $writerIds = DB::table('ledger_writers')->get()->where('movie_id', $movieId);

        $writers = [];

        foreach ($writerIds as $writerId)
        {
            array_push($writers, DB::table('writers')->where('id', $writerId->writer_id)->value('name'));
        }
        
        return $writers;
    }

    public function getMovieGenres($movieId)
    {
        $genreIds = DB::table('ledger_genres')->get()->where('movie_id', $movieId);

        $genres = [];

        foreach ($genreIds as $genreId)
        {
            array_push($genres, DB::table('genres')->where('id', $genreId->genre_id)->value('genre_name'));
        }
        
        return $genres;
    }

    //Takes actor name as string and check in database if it exists
    public function checkIfActorExists($actor) : bool
    {
        return DB::table('actors')->where('name', $actor)->exists();
    }

    public function checkIfProducerExists($producer) : bool
    {
        return DB::table('producers')->where('name', $producer)->exists();
    }

    public function checkIfDirectorExists($director)
    {
        return DB::table('directors')->where('name', $director)->exists();
    }

    public function checkIfMovieExists($movie)
    {
        return DB::table('movies')->where('title', $movie)->exists();
    }

    public function checkIfMovieProducerLedgerExists($producerId, $movieId)
    {
        return DB::table('ledger_producers')->where('producer_id', $producerId)->where('movie_id, $movieId')->exists();
    }

    public function checkIfEpisodeProducerLedgerExists($producerId, $episodeId)
    {
        return DB::table('ledger_producers')->where('producer_id', $producerId)->where('episode_id', $episodeId)->exists();
    }

}
