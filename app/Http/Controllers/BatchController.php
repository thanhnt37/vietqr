<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Events\MultiDeleteBatch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    use HasCallback;

    public function showList(Request $request)
    {
        return view('batch.list');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|min:3|max:255',
            'quantity' => 'required|numeric'
        ]);

        $user = auth()->user();
        $business = $user->guaranteeServices()->first();

        $batch = Batch::create([
            'business_id' => $business->business_id,
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'metadata' => [
                'service' => $request->input('service', 1)
            ]
        ]);

        return $this->callbackRedirect($request, redirect()->route('guarantee.batch.show', ['batch' => $batch->id]));
    }

    public function show(Request $request, Batch $batch)
    {
        return view('batch.show', compact('batch'));
    }

    public function update(Request $request, Batch $batch)
    {
        if ($request->has('service')) {
            $service = $request->input('service');

            if (!in_array($service, [1, 2])) {
                $service = 1;
            }

            $data['metadata'] = [
                'service' => $service
            ];
        }

        if ($request->has('product')) {
            $data['product_id'] = $request->input('product');
        }

        if ($request->has('day')) {
            $data['guarantee_days'] = $request->input('day');
        }

        $batch->update($data);

        return $this->callbackRedirect($request, redirect()->route('guarantee.batch.list'))->with('update', '1');
    }

    public function deleteAll(Request $request)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $ids = $request->input('ids', []);
        $count = count($ids);

        Batch::where('business_id', $business->business_id)->whereIn('id', $ids)->delete();

        event(new MultiDeleteBatch($ids));

        return redirect()->back()->with('message', "Đã xóa {$count} lô mã");
    }
}
