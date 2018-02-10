<?php

namespace App\Http\ViewComposers;

use App\ExportCode;
use Illuminate\View\View;

class LastDownloadComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $downloads = ExportCode::where('business_id', $business->business_id)
            ->where('status', 1)
            ->latest()
            ->limit(10)
            ->get();

        $view->with('downloads', $downloads);
    }
}