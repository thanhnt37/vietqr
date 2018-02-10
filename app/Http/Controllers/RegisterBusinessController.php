<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterBusiness;
use App\Organization;
use App\SystemService;
use App\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterBusinessController extends Controller
{
    use HasCallback;

    public function showFormRegister(Request $request)
    {
        return view('business.register');
    }

    public function register(RegisterBusiness $request)
    {
        $this->addService($request->all());

        return $this->callbackRedirect($request, redirect()->back());
    }

    protected function addService($data)
    {
        $user = auth()->user();

        DB::beginTransaction();

        $business = Organization::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'website' => $data['website'],
            'logo' => $data['logo']
        ]);

        $user->guaranteeServices()->create([
            'business_id' => $business->id
        ]);

        DB::commit();
    }
}
