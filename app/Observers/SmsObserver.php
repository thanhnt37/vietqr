<?php

namespace App\Observers;

use App\Jobs\SendMt;
use App\Mt;
use App\Sms;
use Carbon\Carbon;
use GuzzleHttp\Client;

class SmsObserver
{
    public function created(Sms $sms)
    {
        $job = (new SendMt($sms))->onQueue('sms');

        dispatch($job);
    }
}