<?php

namespace App\Http\Controllers;

use App\GuaranteeActive;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getList(Request $request)
    {
        $business = $this->getBusiness();
        $query = GuaranteeActive::where('business_id', $business->business_id);

        if ($request->has('name')) {
            $name = $request->query('name');
            $query->where('name', 'like', "%{$name}%");
        }

        if ($request->has('phone')) {
            $query->where('phone', '=', $request->query('phone'));
        }

        if ($request->has('email')) {
            $email = $request->query('email');
            $query->where('email', 'like', "%{$email}%");
        }

        if ($request->has('address')) {
            $address = $request->query('address');
            $query->where('address', 'like', "%{$address}%");
        }

        $customers = $query->where('user_active', '=', 1)->latest('active_date')->paginate(24);

        return view('customer.list', compact('customers'));
    }
}