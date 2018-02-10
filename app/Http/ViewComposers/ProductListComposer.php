<?php

namespace App\Http\ViewComposers;

use App\Product;
use Carbon\Carbon;
use Illuminate\View\View;
use Exception;

class ProductListComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $products = $this->filter(request())
            ->where('business_id', $business->business_id)
            ->latest()
            ->paginate(24);

        $view->with('products', $products);
    }

    protected function filter($request)
    {
        $query = Product::query();

        if ($request->has('id')) {
            $query->where('id', $request->query('id'));
        }

        if ($request->has('name')) {
            $name = $request->query('name');
            $query->where('name', 'like', "%{$name}%");
        }

        if ($request->has('gtin')) {
            $query->where('gtin', $request->query('gtin'));
        }

        return $query;
    }
}