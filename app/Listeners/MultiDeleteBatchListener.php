<?php

namespace App\Listeners;

use App\Code;
use App\Events\MultiDeleteBatch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MultiDeleteBatchListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MultiDeleteBatch  $event
     * @return void
     */
    public function handle(MultiDeleteBatch $event)
    {
        $ids = $event->ids;

        Code::whereIn('batch_id', $ids)->delete();
    }
}
