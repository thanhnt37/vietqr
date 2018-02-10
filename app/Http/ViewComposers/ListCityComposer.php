<?php

namespace App\Http\ViewComposers;

use App\City;
use Illuminate\View\View;

class ListCityComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $cities = City::all(['id', 'name']);
        $view->with('cities', $cities);
    }
}