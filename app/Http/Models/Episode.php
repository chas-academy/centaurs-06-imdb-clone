<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'episode.title';
    }
}
