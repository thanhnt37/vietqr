<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Code;
use App\Organization;
use App\Product;
use Illuminate\Http\Request;

class AppViewController extends Controller
{
    public function view(Request $request, $code)
    {
        if (substr($code, 0, 2) == 'D1') {
            return $this->qrmkt($request, $code);
        }

        return $this->qrcode($request, $code);
    }

    protected function qrcode(Request $request, $code)
    {
        $id = code_to_id($code);
        $code = Code::with('product')
            ->where('id', $id)
            ->firstOrFail();

        if ($code->active != 1) {
            return response('tem chưa kích hoạt');
        }

        $business = $code->business;
        $gactive = $code->guaranteeActive;
        $product = $code->product;

        $data = [
            'productName' =>  $product ? $product->name : "Chưa có sản phẩm",
            'productInformation' => $product ? $product->description : null,
            'productImage' => $product && $product->logo ? asset('storage/images/'.$product->logo) : 'holder.js/120x120?text=Image',
            'businessName' => $business->name,
            'businessPhone' => $business->phone,
            'businessEmail' => $business->email,
            'businessAddress' => $business->address,
            'active' => (!$gactive || $gactive->user_active == 0) ? true : false,
            'codeId' => $code->id,
            'sms' => $code->sms(),
            'code' => $code,
            'gactive' => $gactive,
            'service' => $code->batch->metadata['service']
        ];

        $data['agencies'] = Agency::where('business_id', $business->id)->limit(24)->get();

        return view('view', $data);
    }

    protected function qrmkt(Request $request, $code)
    {
        $id = substr($code, 2);
        $business = Organization::findOrFail($id);
//        $products = Product::where('business_id', $business->id)->latest('updated_at')->limit(10)->get();

        return view('view-mkt', compact('business', 'products'));
    }
}
