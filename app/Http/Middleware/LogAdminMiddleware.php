<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;

class LogAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        Log::query()->create([
            'route' => 'admin',
            'method' => $request->method(),
            'url' => $request->url(),
            'url_full' => $request->fullUrl(),
            'ip_address' => $request->ip()
        ]);

        return $next($request);
    }
}
