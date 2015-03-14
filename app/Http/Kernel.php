<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
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
    protected $routeMiddleware = [

        // site (frontend) user authentication
        'auth' => 'App\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',

        // for the backend pages
        'backend-access' => 'App\Http\Middleware\BackendAccess',
        'backend-authorization' => 'App\Http\Middleware\BackendAuthorization',
        'auth.backend' => 'App\Http\Middleware\BackendAuthentication',

        // http security
        'http' => 'App\Http\Middleware\RemoveSSL',
        'https' => 'App\Http\Middleware\RequireSSL',

        // shopping cart & checkout
        'auth.checkout' => 'App\Http\Middleware\CheckoutAuthentication',
        'cart.check' => 'App\Http\Middleware\VerifyShoppingCart',

    ];

}
