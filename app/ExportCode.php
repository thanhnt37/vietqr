<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportCode extends Model
{
    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }
}
