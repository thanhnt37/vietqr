<?php

namespace App\Http\Controllers\Ajax;

use App\LogTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function dailyActiveLog()
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $date = Carbon::now()->subDays(30);
        $logs = LogTime::where('business_id', $business->business_id)
            ->whereDate('date', '>', $date)
            ->limit(30)
            ->oldest('date')
            ->get(['date', 'activated_count']);
        $data = [];

        foreach ($logs as $log) {
            array_push($data, [$log->date->format('Y-m-d'), $log->activated_count]);
        }

        return response()->json($data);
    }

    public function dailyGuaranteeCountLog()
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $date = Carbon::now()->subDays(30);
        $logs = LogTime::where('business_id', $business->business_id)
                        ->whereDate('date', '>', $date)
                        ->limit(30)
                        ->oldest('date')
                        ->get(['date', 'guarantee_count']);
        $data = [];

        foreach ($logs as $log) {
            array_push($data, [$log->date->format('Y-m-d'), $log->guarantee_count]);
        }

        return response()->json($data);
    }
}
