<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware
        = [
            'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
            'Illuminate\Cookie\Middleware\EncryptCookies',
            'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
            'Illuminate\Session\Middleware\StartSession',
            'Illuminate\View\Middleware\ShareErrorsFromSession',
            'App\Http\Middleware\VerifyCsrfToken',
        ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware
        = [
            'auth'           => 'App\Http\Middleware\Authenticate',
            'auth.basic'     => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
            'guest'          => 'App\Http\Middleware\RedirectIfAuthenticated',
            'auth.backend'   => 'App\Http\Middleware\BackendAuthentication',
            'auth.checkout'   => 'App\Http\Middleware\CheckoutAuthentication',
            'http'  => 'App\Http\Middleware\RemoveSSL',
            'https' => 'App\Http\Middleware\RequireSSL',
            'backend-access' => 'App\Http\Middleware\BackendAccess',
            'cart.check'     => 'App\Http\Middleware\VerifyShoppingCart',

        ];

}
