<?php

namespace App\Http\ViewComposers;

use App\GuaranteeActive;
use Illuminate\View\View;

class LastCustomerActiveComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();

        $query = GuaranteeActive::where('business_id', $business->business_id)
            ->where('user_active', '=', 1);

        $request = request();

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

        $customers = $query->paginate(24, ['name', 'email', 'phone', 'address', 'code_id', 'active_date', 'guarantee_days']);

        $view->with('customers', $customers);
    }
}