<?php

namespace App\Http\ViewComposers;

use App\Product;
use Illuminate\View\View;

class ListProductComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $products = Product::where('business_id', $business->business_id)->get(['id', 'name']);
        $view->with('products', $products);
    }
}