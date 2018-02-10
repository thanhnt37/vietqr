<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class BusinessProfileComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = auth()->user();
        $guaranteeService = $user->guaranteeServices()->first();
        $business = $guaranteeService->business;

        $view->with('business', $business);
    }
}