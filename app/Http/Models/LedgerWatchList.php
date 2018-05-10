<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LedgerWatchList extends Model
{
    public function ifMovieExistsInWatchlist($movieId, $userId): bool
    {
        return DB::table('ledger_watch_lists')->where('movie_id', $movieId)->where('user_id', $userId)->exists();
    }
}
