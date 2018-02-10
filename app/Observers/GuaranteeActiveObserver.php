<?php

namespace App\Observers;

use App\Code;
use App\GuaranteeActive;
use App\Jobs\StoreLogActive;

class GuaranteeActiveObserver
{
    public function created(GuaranteeActive $active)
    {
        $job = (new StoreLogActive($active))->onQueue('log');
        dispatch($job);
    }
}