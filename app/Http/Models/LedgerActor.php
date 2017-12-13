<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class LedgerActor extends Model
{
    use Searchable;
}
