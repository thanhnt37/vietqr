<?php

namespace App\Http\Controllers;

use App\UserTutorial;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SettingController extends Controller
{
    use HasCallback;

    public function setting(Request $request)
    {
        return view('setting');
    }

    public function update(Request $request)
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

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = Uuid::uuid4().'.'.$file->extension();
            $file->storeAs('images', $fileName, 'public');
            $data['cover'] = $fileName;
        }

        $data = array_filter($data);

        $guaranteeService->business()->update($data);
        UserTutorial::where('user_id', auth()->user()->id)->where('name', 'update_business')->update([
            'complete' => 1
        ]);

        return $this->callbackRedirect($request, redirect()->back());
    }
}
