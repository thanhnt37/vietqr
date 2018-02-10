<?php

namespace App\Http\ViewComposers;

use App\LogBusiness;
use Illuminate\View\View;

class BusinessLogTotalComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = auth()->user();
        $businesses = $user->guaranteeServices()->first();
        $log = LogBusiness::where('business_id', $businesses->business_id)->first();

        if (is_null($log)) {
            $log = new LogBusiness();
            $log->business_id = $businesses->business_id;
            $log->code = 0;
            $log->code_activated_sms = 0;
            $log->code_activated_app = 0;
        }

        $view->with('log', $log);
    }
}