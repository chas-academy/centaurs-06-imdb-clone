<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use Searchable;

    protected $table = 'actors';

    public function searchableAs()
    {
        return 'actor.name';
    }

    public function movies()
    {
        return $this->belongsToMany('App\Http\Models\Movie');
    }
}
