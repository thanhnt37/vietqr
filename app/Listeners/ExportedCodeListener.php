<?php

namespace App\Listeners;

use App\Events\ExportedCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExportedCodeListener
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
     * @param  ExportedCode  $event
     * @return void
     */
    public function handle(ExportedCode $event)
    {
        $export = $event->export;
        $export->update([
            'status' => 1,
            'file' => $event->filename
        ]);
    }
}
