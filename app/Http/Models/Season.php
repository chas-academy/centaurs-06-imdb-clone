<?php

namespace App\Http\Models;

use App\Http\Models\TvShow;
use App\Episode;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function tvshow()
    {
        return $this->belongsTo('App\Http\Models\TvShow');
    }

    public function episodes()
    {
        return $this->hasMany('App\Episode');
    }
}
