<?php

namespace App\Http\ViewComposers;

use App\Agency;
use Illuminate\View\View;

class AgencyListComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $agencies = $this->filter(request())->where('business_id', $business->business_id)->latest()->paginate(24);

        $view->with('agencies', $agencies);
    }

    protected function filter($request)
    {
        $query = Agency::query();

        if ($request->has('id')) {
            $query->where('id', $request->query('id'));
        }

        if ($request->has('name')) {
            $name = $request->query('name');
            $query->where('name', 'like', "%{$name}%");
        }

        if ($request->has('address')) {
            $address = $request->query('gtin');
            $query->where('address', 'like', "%{$address}%");
        }

        if ($request->has('start_date')) {
            try {
                $date = Carbon::createFromFormat('d/m/Y', $request->query('start_date'));
                $query->whereDate('created_at', '>=', $date);
            } catch (Exception $exception) {
                //
            }
        }

        if ($request->has('end_date')) {
            try {
                $date = Carbon::createFromFormat('d/m/Y', $request->query('end_date'));
                $query->whereDate('created_at', '<=', $date);
            } catch (Exception $exception) {
                //
            }
        }

        return $query;
    }
}