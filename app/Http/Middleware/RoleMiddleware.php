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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();


        if (!$user) {
            return response()->json([
                'message' => 'Not authenticated',
                'auth' => Auth::check(),
                'user' => Auth::id()
            ], 401);
        }

        if (!$user->hasAnyRole($roles)) {
            return response()->json([
                'message' => 'Insufficient permissions',
                'required_roles' => $roles,
                'user_roles' => $user->getRoleNames(),
                'user_id' => $user->id
            ], 403);
        }

        return $next($request);
    }

    /**
     * Return consistent unauthorized response
     */
    protected function unauthorizedResponse(string $message): Response
    {
        return response()->json([
            'message' => 'Unauthorized: ' . $message,
            'user_roles' => optional(Auth::user())->getRoleNames() ?: 'none'
        ], 403);
    }
}