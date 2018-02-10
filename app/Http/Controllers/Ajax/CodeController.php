<?php

namespace App\Http\Controllers\Ajax;

use App\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    const ACTIVE_TYPE_NORMAL = 0;
    const ACTIVE_TYPE_GUARANTEE = 1;

    public function active(Request $request, Code $code)
    {
        $user = auth()->user();

        if ($code->business_id != $user->id) {
            return response()->json([
                'error' => []
            ], 403);
        }

        $type = $request->input('type', static::ACTIVE_TYPE_NORMAL) == 1 ? 1 : 0;
        $active = $request->input('status', 'true') == 'false' ? 0 : 1;
        $column = 'active';

        if ($type == 1) {
            $column = 'guarantee_active';
        }

        $code->update([
            $column => $active
        ]);

        return response()->json([
            'data' => [
                'success' => true
            ]
        ]);
    }
}
