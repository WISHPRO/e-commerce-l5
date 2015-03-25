<?php namespace App\Providers;

use app\Anto\DomainLogic\repositories\Cache\LaravelCache;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
use app\Anto\Logic\repositories\imageProcessor;
use app\Models\Product;
use app\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        // laravel's user registrar
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );

        $this->app->when('app\Anto\domainLogic\contracts\Product\ProductSearch')
            ->needs('app\Anto\DomainLogic\repositories\ProductRepository')
            ->give(new ProductRepository(new Product()));

        // binding the cache interface to our laravelCache class
        $this->app->bind('app\Anto\DomainLogic\contracts\CacheInterface', function ($app) {
            return new LaravelCache($app['cache']);
        });

        // binding our imagingInterface to its counterpart
        $this->app->bind('app\Anto\DomainLogic\contracts\ImagingInterface', function ($app) {
            return new imageProcessor();
        });


    }

}
