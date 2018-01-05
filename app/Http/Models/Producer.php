<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'producer.name';
    }
}
