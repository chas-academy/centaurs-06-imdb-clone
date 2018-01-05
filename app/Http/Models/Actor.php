<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'actor.name';
    }
}
