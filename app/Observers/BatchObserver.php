<?php

namespace App\Observers;

use App\Batch;
use App\Code;
use App\Jobs\DeleteCodeOfBatch;
use App\Jobs\GenerateCode;

class BatchObserver
{
    public function created(Batch $batch)
    {
        $job = (new GenerateCode($batch))->onQueue('generate_code');

        dispatch($job);
    }

    public function deleted(Batch $batch)
    {
        $job = new DeleteCodeOfBatch($batch);

        dispatch($job);
    }

    public function updated(Batch $batch)
    {
        Code::where('batch_id', $batch->id)->update([
            'product_id' => $batch->product_id
        ]);
    }
}