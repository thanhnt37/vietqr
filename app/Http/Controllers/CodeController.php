<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Code;
use App\GuaranteeHistory;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function showList(Request $request)
    {
        $business = $this->getBusiness();
        $batches = Batch::where('business_id', $business->business_id)->get();
        $products = Product::where('business_id', $business->business_id)->get();

        return view('code.list', compact('batches', 'products'));
    }

    public function show(Request $request, Code $code)
    {
        return view('code.show', compact('code'));
    }

    public function searchCode(Request $request)
    {
        $code = $request->input('code');

        $code = Code::whereIn('id', [$code, code_to_id($code), sms_to_id($code)])->first();

        if (! $code) {
            return view('code.search-code');
        }

        return redirect()->route('guarantee.code.show', ['code' => $code]);
    }

    public function update(Request $request, Code $code)
    {
        $code->update([
            'product_id' => $request->input('product')
        ]);

        return $this->callbackRedirect($request, redirect()->back());
    }

    public function delete(Request $request, Code $code)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();

        if ($code->business_id != $business->business_id) {
            return abort(403);
        }

        $code->delete();

        return $this->callbackRedirect($request, redirect()->back());
    }

    public function deleteAll(Request $request)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $ids = $request->input('ids', []);
        $count = count($ids);

        Code::where('business_id', $business->business_id)->whereIn('id', $ids)->delete();

        return redirect()->back()->with('message', "Đã xóa {$count} mã bảo hành");
    }

    public function history(Request $request, $code)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();

        GuaranteeHistory::create([
            'code_id' => $code,
            'date' => Carbon::now(),
            'description' => $request->input('description')
        ]);

        return back();
    }

    public function cgActive(Request $request)
    {
        $code = Code::find($request->input('code'));

        if (! $code || $request->input('sms') != $code->sms()) {
            return redirect()->back();
        }

        $code->update([
            'anti_counterfeit' => 1
        ]);

        return redirect()->back()->with('message', 'Xác thực thành công. Hành động của bạn đã góp phần phát hiện và ngăn chặn các hành vi làm giả sản phẩm');
    }
}
