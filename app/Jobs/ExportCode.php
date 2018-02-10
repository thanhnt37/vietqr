<?php

namespace App\Jobs;

use App\Batch;
use App\Code;
use App\ExportCode as ExportCodeModel;
use App\Events\ExportedCode;
use BaseConvert\Converter;
use File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Storage;
use Zipper;

class ExportCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $export;
    protected $batch;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ExportCodeModel $export, Batch $batch)
    {
        $this->export = $export;
        $this->batch = $batch;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $export = $this->export;
        $batch = $this->batch;
        $directory = "businesses/{$batch->business_id}/exportcode/{$export->id}";
        $this->makeDirectory($directory);
        $filename = $batch->id.'-'.time();
        $i = 1;

        Code::where('batch_id', $batch->id)->select(['id'])->chunk(10000, function ($codes) use ($directory, $filename, &$i) {
            $path = "{$directory}/{$filename}-{$i}.csv";
            $this->storeFile($codes, $path);
            $i++;
        });

        $filename = storage_path('app'.DIRECTORY_SEPARATOR.$directory.'.zip');

        Zipper::make($filename)
            ->add(storage_path('app'.DIRECTORY_SEPARATOR.$directory))
            ->close();

        Storage::deleteDirectory($directory);

        $filename = "{$export->id}.zip";

        event(new ExportedCode($export, $filename));
    }

    protected function storeFile($codes, $path)
    {
        $fp = fopen(storage_path('app'.DIRECTORY_SEPARATOR.$path), 'w');

        foreach ($codes as $code) {
            $id = $code->id;
            $data = [$id, $this->qrcode($id), $this->sms($id)];
            fputcsv($fp, $data);
        }

        fclose($fp);
    }

    protected function makeDirectory($directory)
    {
        if (! File::isDirectory($directory)) {
            Storage::makeDirectory($directory, 0777, true, true);
        }
    }

    protected function sms($id)
    {
        return id_to_sms($id);
    }

    protected function qrcode($id)
    {
        return config('code.url_prefix').id_to_code($id);
    }
}
