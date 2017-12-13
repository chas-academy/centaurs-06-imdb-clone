<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class LedgerProducer extends Model
{
    use Searchable;
}
