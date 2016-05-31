<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\Cors::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth_admin' => \App\Http\Middleware\Authenticate::class,
        'auth' => \App\Http\Middleware\AuthenticateFront::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest_admin' => \App\Http\Middleware\Guest::class,
        'guest' => \App\Http\Middleware\GuestFront::class,
        'cors' => \App\Http\Middleware\Cors::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'is_webmaster' => \App\Http\Middleware\Roles\RoleWebmaster::class,
        'is_admin' => \App\Http\Middleware\Roles\RoleAdmin::class,
        'is_staff' => \App\Http\Middleware\Roles\RoleStaff::class,
    ];
}
