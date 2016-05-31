<?php

namespace App\Http\Middleware;

use App\Models\AdminUser;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Guest
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $adminCpAccess = \Config::get('app.adminCpAccess');
        $adminUser = new AdminUser();
        $user = auth($adminUser->getGuard())->user();

        if (!$user) {
            return redirect()->guest($adminCpAccess . '/auth/login');
        }

        return $next($request);
    }
}
