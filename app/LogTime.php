<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTime extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['date'];
}
