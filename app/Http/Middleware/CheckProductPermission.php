<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProductPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('sanctum')->user();
        $permission = $user->permissions()->get();

        $hasPermission = $permission->where('name', 'manage-products')->first();
        if (! $hasPermission) {
            return response()->json(['error' => 'Você não tem acesso às rotas de produto'], 403);
        }

        return $next($request);
    }
}
