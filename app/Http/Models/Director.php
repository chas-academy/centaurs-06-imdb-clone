<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'director.name';
    }
}
