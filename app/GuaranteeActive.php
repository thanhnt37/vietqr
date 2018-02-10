<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuaranteeActive extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['active_date', 'deleted_at'];

    public function getActiveDate()
    {
        return $this->active_date->format('d-m-Y');
    }

    public function getExpireDate()
    {
        $activeDate = $this->active_date->copy();
        $activeDate->addDays($this->guarantee_days);

        return $activeDate->format('d-m-Y');
    }

    public function business()
    {
        return $this->belongsTo(Organization::class, 'business_id', 'id');
    }
}
