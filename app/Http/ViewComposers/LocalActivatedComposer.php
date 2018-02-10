<?php

namespace App\Http\ViewComposers;

use App\City;
use Illuminate\View\View;

class LocalActivatedComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $cities = City::select(['name'])
            ->withCount(['logActivities' => function ($query) use ($business) {
                $query->where('business_id', $business->business_id);
            }])
            ->having('log_activities_count', '>', 0)
            ->latest('log_activities_count')
            ->limit(6)
            ->get();

        $view->with('cities', $cities);
    }
}