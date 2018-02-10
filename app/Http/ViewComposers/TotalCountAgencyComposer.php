<?php

namespace App\Http\ViewComposers;

use App\Agency;
use Illuminate\View\View;

class TotalCountAgencyComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $count = Agency::where('business_id', $business->business_id)->count();
        $view->with('count', $count);
    }
}