<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, string $roles) : Response
	{
		$user = Auth::user();

		if (!$user || !in_array($user->role, explode('-', $roles))) {
			return response()->json(['message' => 'Access denied.'], Response::HTTP_FORBIDDEN);
		}

		return $next($request);
	}
}
