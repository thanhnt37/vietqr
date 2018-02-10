<?php

namespace App\Http\Controllers\Ajax;

use App\Batch;
use App\ExportCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'type' => 'required|in:csv',
            'title' => 'required|min:3:max:255',
            'batch_id' => 'required|exists:batches,id'
        ]);

        if ($validator->fails()) {
            return response('', 400);
        }

        $batch = Batch::find($request->input('batch_id'));

        ExportCode::create([
            'business_id' => $batch->business_id,
            'batch_id' => $request->input('batch_id'),
            'type' => $request->input('type'),
            'title' => $request->input('title'),
        ]);

        return response('', 200);
    }
}
