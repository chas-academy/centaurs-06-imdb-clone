<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Writer extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'writer.name';
    }

    protected $table = 'writers';
}
