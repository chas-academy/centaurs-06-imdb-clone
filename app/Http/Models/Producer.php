<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Producer extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'producer.name';
    }

    protected $table = 'producers';
}
