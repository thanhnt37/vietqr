<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function scopeActive($query, $active)
    {
        return $query->where('active', $active);
    }

    public function scopeActived($query)
    {
        return $query->where('active', 1);
    }

    public function scopeBlocked($query)
    {
        return $query->where('active', 0);
    }

    public function getCodeAttribute()
    {
        return $this->attributes['id'];
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id','id');
    }

    public function histories()
    {
        return $this->hasMany(GuaranteeHistory::class, 'code_id', 'id');
    }

    public function business()
    {
        return $this->belongsTo(Organization::class, 'business_id', 'id');
    }

    public function sms()
    {
        return id_to_sms($this->id);
    }

    public function code()
    {
        return id_to_code($this->id);
    }

    public function guaranteeActive()
    {
        return $this->hasOne(GuaranteeActive::class, 'code_id', 'id');
    }
}
