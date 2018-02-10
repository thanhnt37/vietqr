<?php

namespace App\Jobs;

use App\Batch;
use App\Code;
use App\Events\GeneratedCode;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batch;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $batch = $this->batch;
        $total = $batch->quantity;
        $c = 0;
        $codes = [];
        $time = Carbon::now();

        while ($c < $total) {
            for ($i = 0; $i < 1000; $i++) {
                array_push($codes, [
                    'business_id' => $batch->business_id,
                    'product_id' => $batch->product_id,
                    'batch_id' => $batch->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);

                $c++;

                if ($c >= $total) {
                    break;
                }
            }

            Code::insert($codes);
            $codes = [];
        }

        event(new GeneratedCode($batch));
    }
}
