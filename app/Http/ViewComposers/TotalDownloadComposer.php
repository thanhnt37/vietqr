<?php

namespace App\Http\ViewComposers;

use App\ExportCode;
use Illuminate\View\View;

class TotalDownloadComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $count = ExportCode::where('business_id', $business->business_id)->count();
        $view->with('count', $count);
    }
}