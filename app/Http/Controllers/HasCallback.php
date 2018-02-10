<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait HasCallback
{
    protected function callbackRedirect(Request $request, $redirect)
    {
        if ($request->has('continue')) {
            return redirect()->away($request->input('continue'));
        }

        return $redirect;
    }
}