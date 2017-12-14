<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Actor extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'actor.name';
    }

    protected $table = 'actors';
}
