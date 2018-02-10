<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActive extends Model
{
    public $timestamps = false;
    protected $dates = ['time'];
}
