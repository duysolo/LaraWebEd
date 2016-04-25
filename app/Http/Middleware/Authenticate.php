<?php

namespace App\Http\Middleware;

use App\Models\AdminUser;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $adminCpAccess = \Config::get('app.adminCpAccess');
        $user = session('adminAuthUser');
        if(!$user)
        {
            return redirect()->guest($adminCpAccess.'/auth/login');
        }

        /*Refresh logged in user*/
        $user = AdminUser::find($user->id);
        if(!$user)
        {
            return redirect()->guest($adminCpAccess.'/auth/login');
        }
        session([
            'adminAuthUser' => $user
        ]);

        return $next($request);
    }
}
