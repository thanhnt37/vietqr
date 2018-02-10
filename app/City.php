<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function logActivities()
    {
        return $this->hasMany(LogActive::class, 'city_id', 'id');
    }
}
