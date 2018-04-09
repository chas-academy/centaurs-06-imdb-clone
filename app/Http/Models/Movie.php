<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Http\Models\Genre;
use Illuminate\Support\Facades\Storage;

use DB;

class Movie extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'movie.title';
    }

    
    public function createMovie($properties)
    {
        
        if(!$this->ifMovieExists($properties['title'])) {
            
            DB::table('movies')->insert([
                'movie_api_id' => $properties['id'],
                'title' => $properties['title'],
                'plot' => $properties['overview'],
                'playtime' => $properties['runtime'],
                'poster' => $properties['poster_path'],
                'backdrop' => $properties['backdrop_path'],
                'releasedate' => $properties['release_date'],
                'imdb_rating' => $properties['vote_average'],
                'chas_rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $movie = $this->getMovieByTitle($properties['title']);
            $genres = [];
            foreach ($properties['genres'] as $genre) {
                array_push($genres, $genre['id']);
            }
            $genres = $this->getGenres($genres);
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

    public function getGenres($genreIds)
    {
        $genres = [];
        foreach ($genreIds as $id) {
            array_push($genres , DB::table('genres')->get()->where('api_genre_id', $id)->first());
        }

        return $genres;
    }

    public static function getAllMovies() 
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

    public function getAllMoviesFromWatchlist($userId)
    {
        $watchlistMovies = DB::table('ledger_watch_lists')->where('user_id', $userId)->pluck('movie_id');

        $moviesWatch = [];

        foreach ($watchlistMovies as $watchlistMovie) {
            array_push($moviesWatch, DB::table('movies')->get()->where('id', $watchlistMovie)->first());
        }

        $movies = array_filter($moviesWatch);

        return $movies;
        
    }

    public function getAllTvShowsFromWatchlist($userId)
    {
        $watchlistTvshows = DB::table('ledger_watch_lists')->where('user_id', $userId)->pluck('tvshow_id');

        $tvshowsWatch = [];

        foreach ($watchlistTvshows as $watchlistTvshow) {
            array_push($tvshowsWatch, DB::table('tv_shows')->get()->where('id', $watchlistTvshow)->first());
        }

        $tvshows = array_filter($tvshowsWatch);

        return $tvshows;

    }

    public function removeMovieFromWatchlist($userId, $movieId)
    {
        DB::table('ledger_watch_lists')->where('user_id', $userId)->where('movie_id', $movieId)->delete();
    }

    public function addMovieToWatchlist($userId, $movieId)
    {
        DB::table('ledger_watch_lists')->insert([
            'user_id' => $userId,
            'movie_id' => $movieId
        ]);
    }
    
    public function getMoviesByGenre($genre)
    {
        $genresModel = new Genre();
        $genres = $genresModel->getAllGenres();
        $genreId = DB::table('genres')->where('genre_name', $genre)->value('id');
        $ledgerMovieIds = DB::table('ledger_genres')->where('genre_id', $genreId)->pluck('movie_id');

        $movies = [];
        foreach ($ledgerMovieIds as $movieId) {
            array_push($movies, DB::table('movies')->get()->where('id', $movieId)->first());
        }

        echo json_encode($movies);
        exit();

        return $movies;
    }

    public function getMoviesBySpecSorting($option)
    {

        // GET THE WORST RATED MOVIES
        if($option == 'lowImdb')
        {
            $dbtests = DB::table('movies')->orderBy('imdb_rating', 'asc')->get();
            $movies = [];
            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
        // GET MOVIES BY NEWEST FIRST
        elseif($option == 'releaseNew')
        {
            $dbtests = DB::table('movies')->orderBy('releasedate', 'desc')->get();
            $movies = [];
            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }            
            echo json_encode($movies);
            exit();
        }
        elseif($option == 'releaseOld')
        {
            // GET MOVIES BY OLDEST FIRST
            $dbtests = DB::table('movies')->orderBy('releasedate', 'asc')->get();
            $movies = [];
            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
        elseif($option == 'top15')
        {
            // GET TOP 15 MOVIES
            $dbtests = DB::table('movies')->orderBy('imdb_rating', 'desc')->limit(15)->get();
            $movies = [];

            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
        elseif($option == 'topAllTime')
        {
            // GET TOP ALL TIME MOVIES
            $dbtests = DB::table('movies')->orderBy('releasedate', 'asc')->orderBy('imdb_rating', 'asc')->get();
            $movies = [];
            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();

        }
        elseif($option == 'topChas')
        {
            // GET TOP CHAS MOVIES
            $dbtests = DB::table('movies')->orderBy('chas_rating', 'desc')->get();
            $movies = [];
            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
        elseif($option == 'topImdb')
        {
            // GET TOP MOVIES BY IMDB RATING
            $dbtests = DB::table('movies')->orderBy('imdb_rating', 'desc')->get();
            $movies = [];
            foreach($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
        elseif($option == 'a-z')
        {
            // GET MOVIES A-Z
            $dbtests = DB::table('movies')->orderBy('title', 'asc')->get();
            $movies = [];
            foreach ($dbtests as $dbtest ) 
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();

        }
        elseif($option == 'z-a')
        {
            // GET MOVIES Z-A
            $dbtests = DB::table('movies')->orderBy('title', 'desc')->get();
            $movies = [];
            foreach ($dbtests as $dbtest ) 
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
        elseif($option == 'topScore')
        {
            // GET MOVIES WITH BEST SCORE
            $dbtests = DB::table('movies')->orderBy('imdb_rating', 'desc')->get();
            $movies = [];
            foreach ($dbtests as $dbtest)
            {
                array_push($movies, $dbtest);
            }
            echo json_encode($movies);
            exit();
        }
    }

    public function deleteMovie($movieId): bool
    {
        if($this->ifMovieExistsId($movieId)) {
            DB::table('ledger_actors')->where('movie_id', $movieId)->delete();
            DB::table('ledger_directors')->where('movie_id', $movieId)->delete();
            DB::table('ledger_genres')->where('movie_id', $movieId)->delete();
            DB::table('ledger_producers')->where('movie_id', $movieId)->delete();
            DB::table('ledger_writers')->where('movie_id', $movieId)->delete();
            //TODO: remove comment when ledger_watch_lists exists in db.
            //DB::table('ledger_watch_lists')->where('movie_id', $movieId)->delete();
            DB::table('movies')->where('id', $movieId)->delete();
            return true;
        }else {
            return false;
        }
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
    public function ifMovieExistsId($movieId)
    {
        return DB::table('movies')->where('id', $movieId)->exists();
    }

    public function ifGenreExists($genreName): bool
    {
        return DB::table('genres')->where('genre_name', $genreName)->exists();
    }

    public function ifGenreMovieLedgerExists($movieId, $genreId): bool
    {
        return DB::table('ledger_genres')->where('movie_id', $movieId)->where('genre_id', $genreId)->exists();
    }

    public function ifGenreEpisodeLedgerExists($tvshowId, $genreId): bool
    {
        return DB::table('ledger_genres')->where('tvshow_id', $tvshowId)->where('genre_id', $genreId)->exists();
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

    // Helperfunction to assess what type of imgurl should be returned for posters
    public static function getPosterUrl($poster)
    {
        $imdbUrl = config('app.poster_url');

        if (!$poster) {
            return '/img/missingposter/missingposter.png';
        }

        $exists = Storage::disk('public')->exists('/posters/'.$poster);

        if ($exists) {
            return asset('storage/posters/'.$poster);
        }

        return $imdbUrl.$poster;
    }

    public function actors()
    {
        return $this->belongsToMany('App\Http\Models\Actor', 'ledger_actors', 'movie_id', 'actor_id');
    }

    public function producers()
    {
        return $this->belongsToMany('App\Http\Models\Producer', 'ledger_producers', 'movie_id', 'producer_id');
    }

    public function directors()
    {
        return $this->belongsToMany('App\Http\Models\Director', 'ledger_directors', 'movie_id', 'director_id');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Http\Models\Genre', 'ledger_genres', 'movie_id', 'genre_id');
    }

}
