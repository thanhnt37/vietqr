<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuaranteeHistory extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    public $timestamps = false;
}
