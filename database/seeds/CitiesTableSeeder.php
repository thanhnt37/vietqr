<?php

use App\City;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! file_exists($path = storage_path('app/city_vn.csv'))) {
            return;
        }

        if (($handler = fopen($path, 'r')) !== false) {

            $cities = [];
            $date = Carbon::now();

            while (($city = fgetcsv($handler, 1000, ',')) !== false) {
                array_push($cities, ['name' => $city[0], 'created_at' => $date, 'updated_at' => $date]);
            }

            City::insert($cities);
        }
    }
}
