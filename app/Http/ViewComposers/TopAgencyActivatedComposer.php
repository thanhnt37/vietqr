<?php

namespace App\Http\ViewComposers;

use App\Agency;
use Illuminate\View\View;

class TopAgencyActivatedComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $agencies = Agency::where('business_id', $business->business_id)
            ->select(['name'])->withCount('logActivities')
            ->orderByDesc('log_activities_count')
            ->limit(10)
            ->get();

        $view->with('agencies', $agencies);
    }
}