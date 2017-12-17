<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Director extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'director.name';
    }

    protected $table = 'directors';
}
