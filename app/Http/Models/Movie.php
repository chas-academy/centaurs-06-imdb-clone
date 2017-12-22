<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use DB;

class Movie extends Model
{
    public function createMovie($properties) 
    {
        if(!$this->ifMovieExists($properties['results'][0]['title'])) {
            
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
        $movie = $this->getLatestCreatedMovie();

        for ($i=0; $i < 5; $i++) {
            if(isset($properties['cast'][$i])){                                 //if there is less than 5 casts then dont to add to db.             
                if(!$this->ifActorExists($properties['cast'][$i]['name'])) {    //Checks if actor exists in db
                    DB::table('actors')->insert([
                        'movie_api_id' => $properties['id'],
                        'name' => $properties['cast'][$i]['name']
                        ]);
                }
    
                $actor = $this->getActors($properties['cast'][$i]['name']);
    
                if(!$this->ifActorMovieLedgerExists($actor->id, $movie->id)){
                    DB::table('ledger_actors')->insert([
                        'actor_id' => $actor->id,
                        'movie_id' => $movie->id
                        ]);
                }
            } 
        }

        foreach ($properties['crew'] as $crewMember) 
        {
            
            if ($crewMember['job'] === 'Director') {
                if(!$this->ifDirectorExists($crewMember['name'])) {
                    DB::table('directors')->insert([
                        'movie_api_id' => $properties['id'],
                        'name' => $crewMember['name']
                        ]);
                }                

                $director = $this->getDirectors($crewMember['name']);
                
                if(!$this->ifMovieDirectorLedgerExists($director->id, $movie->id)){
                    DB::table('ledger_directors')->insert([
                        'director_id' => $director->id,
                        'movie_id' => $movie->id
                        ]);

                }
            } 
                    
            if ($crewMember['job'] === 'Producer') {
                
                if(!$this->ifProducerExists($crewMember['name'])) {
                    DB::table('producers')->insert([
                        'movie_api_id' => $properties['id'],
                        'name' => $crewMember['name']
                        ]);
                }
                    
                $producer = $this->getProducers($crewMember['name']);

                if(!$this->ifMovieProducerLedgerExists($producer->id, $movie->id))
                DB::table('ledger_producers')->insert([
                    'producer_id' => $producer->id,
                    'movie_id' => $movie->id
                ]);
            }

            if ($crewMember['department'] === 'Writing') 
            {     
                if(!$this->ifWriterExists($crewMember['name'])){
                    DB::table('writers')->insert([
                        'movie_api_id' => $properties['id'],
                        'name' => $crewMember['name']
                        ]);
                }
                $writer = $this->getWriters($crewMember['name']);

                if(!$this->ifWriterMovieLedgerExists($writer->id, $movie->id)){
                    DB::table('ledger_writers')->insert([
                        'writer_id' => $writer->id,
                        'movie_id' => $movie->id
                    ]);
                } 
            }
        } 
    }

    public function createMovieGenres($properties) 
    {
        foreach ($properties['genres'] as $genre) {
            if(!$this->ifGenreExists($genre['name'])){
                    DB::table('genres')->insert([
                        'genre_name' => $genre['name'],
                        'api_genre_id' => $genre['id']
                    ]);
            }
        }             
    }

    public function getLatestCreatedMovie() 
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
    public function ifActorExists($actorName) : bool
    {
        return DB::table('actors')->where('name', $actorName)->exists();
    }

    public function ifActorMovieLedgerExists($actorId, $movieId): bool
    {
        return DB::table('ledger_actors')->where('actor_id', $actorId)->where('movie_id', $movieId)->exists();
    }

    public function ifMovieExists($movieTitle): bool
    {
        return DB::table('movies')->where('title', $movieTitle)->exists();
    }

    public function ifGenreExists($genreName): bool
    {
        return DB::table('genres')->where('genre_name', $genreName)->exists();
    }

    public function ifGenreMovieLedgerExists($movieId, $genreId): bool
    {
        return DB::table('ledger_genres')->where('movie_id', $movieId)->where('genre_id', $genreId)->exists();
    }

    public function ifGenreEpisodeLedgerExists($episodeId, $genreId): bool
    {
        return DB::table('ledger_genres')->where('episode_id', $episodeId)->where('genre_id', $genreId)->exists();
    }

    public function ifProducerExists($producerName): bool
    {
        return DB::table('producers')->where('name', $producerName)->exists();
    }
    
    public function ifMovieProducerLedgerExists($producerId, $movieId): bool
    {
        return DB::table('ledger_producers')->where('producer_id', $producerId)->where('movie_id', $movieId)->exists();
    }

    public function ifDirectorExists($directorName): bool
    {
        return DB::table('directors')->where('name', $directorName)->exists();
    }

    public function ifMovieDirectorLedgerExists($directorId, $movieId): bool
    {
        return DB::table('ledger_directors')->where('director_id', $directorId)->where('movie_id', $movieId)->exists();
    }

    public function ifWriterExists($writerName): bool
    {
        return DB::table('writers')->where('name', $writerName)->exists();
    }

    public function ifWriterMovieLedgerExists($writerId, $movieId): bool
    {
        return DB::table('ledger_writers')->where('writer_id', $writerId)->where('movie_id', $movieId)->exists();
    }
}
