<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'setting' => 'array'
    ];
}
