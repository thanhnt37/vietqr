<?php

namespace App\Http\Controllers\Ajax;

use App\UserTutorial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTutorialController extends Controller
{
    public function remindUpdateBusiness(Request $request)
    {
        $user = auth()->user();
        $time = Carbon::now();

        UserTutorial::updateOrCreate([
            'user_id' => $user->id,
            'name' => 'update_business',
        ], [
            'complete' => 0,
            'last' => $time
        ]);

        return response()->json([
            'data' => [
                'success' => true
            ]
        ]);
    }
}
