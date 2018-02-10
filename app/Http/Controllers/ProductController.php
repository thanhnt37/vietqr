<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Product;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    public function showList(Request $request)
    {
        return view('product.list');
    }

    public function insert(StoreProduct $request)
    {
        $business = $this->getBusiness();

        $fileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Uuid::uuid4().'.'.$file->extension();
            $file->storeAs('images', $fileName, 'public');
        }

        Product::create([
            'business_id' => $business->business_id,
            'name' => $request->input('name'),
            'gtin' => $request->input('gtin'),
            'price' => $request->input('price'),
            'logo' => $fileName
        ]);

        return $this->callbackRedirect($request, redirect()->back());
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(UpdateProduct $request, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'gtin' => $request->input('gtin'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Uuid::uuid4().'.'.$file->extension();
            $file->storeAs('images', $fileName, 'public');
            $data['logo'] = $fileName;
        }

        Product::where('id', $id)->update($data);

        return redirect()->route('guarantee.product.list')->with('message', 'Đã cập nhật sản phẩm với ID '.$id);
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Đã xóa sản phẩm với ID '.$id);
    }

    public function deleteAll(Request $request)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $ids = $request->input('ids', []);
        $count = count($ids);

        Product::where('business_id', $business->business_id)->whereIn('id', $ids)->delete();

        return redirect()->back()->with('message', "Đã xóa {$count} sản phẩm");
    }
}
