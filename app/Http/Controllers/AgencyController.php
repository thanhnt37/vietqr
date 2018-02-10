<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Product;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function showList(Request $request)
    {
        return view('agency.list');
    }

    public function insert(Request $request)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();

        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'city' => 'required|exists:cities,id'
        ]);

        $agency = Agency::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city_id' => $request->input('city'),
            'business_id' => $business->business_id,
        ]);

        return redirect()->back()->with('message', 'Đã tạo điểm bảo hành với ID '.$agency->id);
    }

    public function edit(Agency $agency)
    {
        return view('agency.edit', compact('agency'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'city' => 'required|exists:cities,id'
        ]);

        Agency::where('id', $id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city_id' => $request->input('city'),
        ]);

        return redirect()->route('guarantee.agency.list')->with('message', 'Đã cập nhật điểm bán với ID '.$id);
    }

    public function delete($id)
    {
        Agency::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Đã xóa điểm bảo hành với ID '.$id);
    }

    public function deleteAll(Request $request)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $ids = $request->input('ids', []);
        $count = count($ids);

        Agency::where('business_id', $business->business_id)->whereIn('id', $ids)->delete();

        return redirect()->back()->with('message', "Đã xóa {$count} điểm bảo hành");
    }
}
