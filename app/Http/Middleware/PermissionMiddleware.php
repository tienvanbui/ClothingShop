<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$permissions, $guard = 'web')
    {
        $authGuard  = app('auth')->guard($guard);
        if ($authGuard->guest()) {
            throw  UnauthorizedException::notLoggedIn();
        }
        $permissions = is_array($permissions) ? $permissions : explode('|', $permissions);
        $userHasPermission = (($authGuard->user()->role)->permissions)->pluck('key_code');
        foreach ($permissions as $permission) {
            if (in_array($permission,$userHasPermission->toArray())) {
                return $next($request);
            }
        }
        
        throw UnauthorizedException::forPermissions($permissions);
    }
}
