<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use Searchable;

    protected $table = 'directors';

    public function searchableAs()
    {
        return 'director.name';
    }

    public function movies()
    {
        return $this->belongsToMany('App\Http\Models\Movie');
    }
}
