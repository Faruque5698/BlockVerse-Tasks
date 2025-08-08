<?php

namespace App\Http\Middleware;

use App\Http\Resources\ApiResponseErrorResource;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $permission): Response
    {
        if (! Gate::allows($permission)) {
            return (new ApiResponseErrorResource([
                'message' => 'Unauthorized – Permission denied.',
                'errors' => ['permission' => "Missing permission: {$permission}"],
            ]))->response()->setStatusCode(403);
        }

        return $next($request);
    }
}
