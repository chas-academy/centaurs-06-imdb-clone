<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class LedgerDirector extends Model
{
    use Searchable;
}
