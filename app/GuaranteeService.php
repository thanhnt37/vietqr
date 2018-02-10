<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuaranteeService extends Model
{
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Organization::class, 'business_id');
    }
}
