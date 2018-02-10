<?php

namespace App\Http\ViewComposers;

use App\Batch;
use Illuminate\View\View;

class TotalCountBatchComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $count = Batch::where('business_id', $business->business_id)->count();
        $view->with('count', $count);
    }
}