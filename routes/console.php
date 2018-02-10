<?php

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    if (($handle = fopen(storage_path('app/city_vn.csv'), "r")) !== FALSE) {

        $d = [];
        $now = Carbon::now();

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            array_push($d, [
                'name' => $data[0],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        \App\City::insert($d);

        fclose($handle);
    }
})->describe('Display an inspiring quote');
