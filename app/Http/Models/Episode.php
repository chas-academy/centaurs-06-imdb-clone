<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

use App\Season;

class Episode extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'episode.title';
    }

    public function season()
    {
        return $this->belongsTo('App\Season');
    }
}
