<?php

namespace App\Http\ViewComposers;

use App\Product;
use Illuminate\View\View;

class TotalCountProductComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $count = Product::where('business_id', $business->business_id)->count();
        $view->with('count', $count);
    }
}