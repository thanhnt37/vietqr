<?php

namespace App\Http\ViewComposers;

use App\Code;
use Illuminate\View\View;

class TotalCountCodeComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $count = Code::where('business_id', $business->business_id)->count();
        $view->with('count', $count);
    }
}