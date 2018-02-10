<?php

namespace App\Jobs;

use App\Code;
use App\GuaranteeActive;
use App\LogBusiness;
use App\LogTime;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class StoreLogActive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $active;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GuaranteeActive $active)
    {
        $this->active = $active;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $active = $this->active;
        $code = Code::find($active->code_id);

        if (! $code) {
            return;
        }

        LogTime::updateOrCreate([
            'business_id' => $code->business_id,
            'date' => $active->active_date->format('Y-m-d')
        ], [
            'activated_count' => DB::raw('activated_count + 1'),
            'guarantee_count' => DB::raw('guarantee_count + 1'),
        ]);

        LogBusiness::updateOrCreate([
            'business_id' => $code->business_id,
        ], [
            'code_activated_app' => DB::raw('code_activated_app + 1')
        ]);
    }
}
