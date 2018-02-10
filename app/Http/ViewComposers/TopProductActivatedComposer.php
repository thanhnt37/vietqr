<?php

namespace App\Http\ViewComposers;

use App\Product;
use Illuminate\View\View;

class TopProductActivatedComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $products = \App\Product::where('business_id', $business->business_id)
            ->select(['name'])->withCount(['logActivities'])
            ->orderByDesc('log_activities_count')
            ->limit(10)
            ->get();

        $view->with('products', $products);
    }
}