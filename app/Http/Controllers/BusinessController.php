<?php

namespace App\Http\Controllers;

use App\Organization;
use App\UserTutorial;
use Illuminate\Http\Request;
use File;

class BusinessController extends Controller
{
    public function information(Request $request)
    {
        return view('business.information');
    }

    public function updateInformation(Request $request)
    {
        $guaranteeService = auth()->user()->guaranteeServices()->first();

        $data = [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'description' => $request->input('description')
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Uuid::uuid4().'.'.$file->extension();
            $file->storeAs('images', $fileName, 'public');
            $data['logo'] = $fileName;
        }

        $guaranteeService->business()->update($data);
        UserTutorial::where('user_id', auth()->user()->id)->where('name', 'update_business')->update([
            'complete' => 1
        ]);

        return $this->callbackRedirect($request, redirect()->back());
    }

    public function qrcode(Request $request, Organization $business)
    {
        if (! File::exists($business->getQrPath())) {
            $business->generateQrcode();
        };

        return response()->file($business->getQrPath());
    }

    public function download(Request $request, Organization $business)
    {
        if (! File::exists($business->getQrPath())) {
            $business->generateQrcode();
        };

        return response()->download($business->getQrPath());
    }
}
