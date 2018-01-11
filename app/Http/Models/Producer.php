<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use Searchable;

    protected $table = 'producers';

    public function searchableAs()
    {
        return 'producer.name';
    }

    public function movies()
    {
        return $this->belongsToMany('App\Http\Models\Movie');
    }

}
