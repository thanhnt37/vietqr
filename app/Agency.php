<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function logActivities()
    {
        return $this->hasMany(LogActive::class, 'agency_id', 'id');
    }
}
