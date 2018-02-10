<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sms;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function active(Request $request)
    {
        $data = $request->only([
            'partnerid',
            'moid',
            'userid',
            'shortcode',
            'telcocode',
            'keyword',
            'content',
            'transdate',
            'checksum',
            'amount'
        ]);

        Sms::create($data);

        return response('requeststatus=200');
    }
}