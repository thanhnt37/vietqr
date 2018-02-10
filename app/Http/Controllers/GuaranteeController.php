<?php

namespace App\Http\Controllers;

use App\Code;
use App\GuaranteeActive;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    public function index(Request $request)
    {
        return view('guarantee.index');
    }

    public function active(Request $request)
    {
        $code = Code::find($request->input('code'));

        if ($code) {
            $activeDate = Carbon::now();

            GuaranteeActive::updateOrCreate([
                'code_id' => $request->input('code'),
                'business_id' => $code->business_id,
            ], [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'active_date' => $activeDate,
                'guarantee_days' => $request->input('guarantee_days'),
                'user_active' => $request->has('name') ? 1 : 0,
            ]);
        }

        return redirect()->back();
    }

    public function userActive(Request $request)
    {
        $code = Code::find($request->input('code'));

        if (! $code) {
            return redirect()->back();
        }

        $gactive = $code->guaranteeActive;

        if (! $gactive) {
            $gactive = GuaranteeActive::create([
                'code_id' => $request->input('code'),
                'business_id' => $code->business_id,
                'active_date' => Carbon::now(),
                'guarantee_days' => $code->batch->guarantee_days
            ]);
        }

        $gactive->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'address_buy' => $request->input('address_buy'),
            'user_active' => 1,
        ]);

        return redirect()->back()->with('message', 'Sản phẩm đã được kích hoạt và được bảo hành đến ' . $gactive->getExpireDate());
    }
}
