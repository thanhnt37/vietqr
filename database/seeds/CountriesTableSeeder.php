<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = explode(PHP_EOL, Storage::get('countries.json'));
        $list = collect();

        foreach ($countries as $country) {
            $country = json_decode($country, true);

            unset($country['dialing_prefix']);

            $time = \Carbon\Carbon::now();
            $country['created_at'] = $time;
            $country['updated_at'] = $time;

            $list->push($country);
        }

        $list = $list->sortBy('name');

        Country::insert($list->toArray());
    }
}
