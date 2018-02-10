<?php

namespace App\Observers;

use App\Batch;
use App\ExportCode;
use App\Jobs\ExportCode as JobExportCode;

class ExportCodeObserver
{
    public function created(ExportCode $exportCode)
    {
        $batch = Batch::find($exportCode->batch_id);
        $job = (new JobExportCode($exportCode, $batch))->onQueue('export_code');
        dispatch($job);
    }
}