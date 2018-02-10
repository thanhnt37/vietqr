<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function getShortName($word = 6)
    {
        return Str::words($this->name, $word);
    }

    public function logActivities()
    {
        return $this->hasMany(LogActive::class, 'product_id', 'id');
    }
}
