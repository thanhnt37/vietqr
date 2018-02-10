<?php

namespace App\Http\Controllers;

use App\ExportCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExportCodeController extends Controller
{
    public function all(Request $request)
    {
        $user = auth()->user();
        $business = $user->guaranteeServices()->first();
        $exports = $this->filter($request)->where('business_id', $business->business_id)
            ->latest()
            ->paginate(24);

        return view('exportcode.all', compact('exports'));
    }

    public function download(Request $request, ExportCode $export)
    {
        $directory = "businesses/{$export->business_id}/exportcode";
        $filename = $export->file;
        $path = storage_path('app').DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR.$filename;

        return response()->download($path, $export->batch->id."__".snake_case(Str::ascii($export->batch->name))."__".snake_case(Str::ascii($export->title))."__".$filename);
    }

    public function delete(ExportCode $export)
    {
        $export->delete();

        return redirect()->back();
    }

    protected function filter($request)
    {
        $query = ExportCode::query()->with('batch');

        if ($request->has('type') && in_array($request->query('type'), ['csv'])) {
            $query->where('type', $request->query('type'));
        }

        if ($request->has('title')) {
            $title = $request->query('title');
            $query->where('title', 'like', "%{$title}%");
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
