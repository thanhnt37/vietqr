<?php

namespace App\Http\Middleware;

use Closure;

class HasService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $service)
    {
        $user = auth()->user();

        switch ($service) {
            case 'guarantee':
                if (! $user->hasGuaranteeService()) {
                    return redirect()->route('business.register', ['continue' => $request->fullUrl()]);
                }
                break;
            default:
                throw new \Exception('Service not found');
        }

        return $next($request);
    }
}
