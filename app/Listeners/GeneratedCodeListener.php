<?php

namespace App\Listeners;

use App\Events\GeneratedCode;
use App\LogBusiness;
use DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneratedCodeListener
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
     * @param  GeneratedCode  $event
     * @return void
     */
    public function handle(GeneratedCode $event)
    {
        $batch = $event->batch;
        $batch->update([
            'generate_code_status' => 1
        ]);

        LogBusiness::updateOrCreate([
            'business_id' => $batch->business_id,
        ], [
            'code' => DB::raw("code + {$batch->quantity}"),
        ]);
    }
}
