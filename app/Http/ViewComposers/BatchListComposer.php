<?php

namespace App\Http\ViewComposers;

use App\Batch;
use Carbon\Carbon;
use Exception;
use Illuminate\View\View;

class BatchListComposer
{
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $batches = $this->filter(request())->where('business_id', $business->business_id)->paginate(24);
        $view->with('batches', $batches);
    }

    protected function filter($request)
    {
        $query = Batch::query();

        if ($request->has('id')) {
            $query->where('id', $request->query('id'));
        }

        if ($request->has('name')) {
            $name = $request->query('name');
            $query->where('name', 'like', "%{$name}%");
        }

        if ($request->has('quantity')) {
            $value = $request->query('quantity');
            $operator = preg_replace('/[^><=]/', '', $value);
            $quantity = preg_replace('/[^0-9]/', '', $value);

            if (in_array($operator, ['>', '>=', '<', '<=', '='])) {
                $query->where('quantity', $operator, $quantity);
            }
        }

        if ($request->has('product') && $request->query('product') != 'all') {
            $query->where('product_id', $request->query('product'));
        }

        if ($request->has('generated')) {
            $query->where('generate_code_status', $request->query('generated'));
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