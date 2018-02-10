<?php

namespace App\Http\ViewComposers;

use App\Code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListCodeComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $codes = $this->filter(request())->where('business_id', $business->business_id)->paginate(24);
        $view->with('codes', $codes);
    }

    protected function filter($request)
    {
        $query = Code::query();

        if ($request->has('id')) {
            $query->where('id', $request->query('id'));
        }

        if ($request->has('code')) {
            $id = code_to_id($request->query('code'));

            $query->where('id', $id);
        }

        if ($request->has('sms')) {
            $id = sms_to_id($request->query('sms'));

            $query->where('id', $id);
        }

        if ($request->has('batch') && $request->query('batch') != 'all') {
            $query->where('batch_id', $request->query('batch'));
        }

        if ($request->has('product') && $request->query('product') != 'all') {
            $query->where('product_id', $request->query('product'));
        }

        if ($request->has('active')) {
            $query->where('active', $request->query('active'));
        }

        if ($request->has('gactive')) {
            $query->where('guarantee_active', $request->query('gactive'));
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