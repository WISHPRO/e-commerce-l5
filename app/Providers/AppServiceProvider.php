<?php namespace App\Providers;

use app\Anto\DomainLogic\repositories\Cache\LaravelCache;
use app\Anto\DomainLogic\repositories\Product\ProductRepository;
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
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );


        $this->app->when('app\Anto\domainLogic\repositories\Product\ProductSearch')
            ->needs('app\Anto\DomainLogic\repositories\ProductRepository')
            ->give(new ProductRepository(new Product()));

        $this->app->bind('app\Anto\DomainLogic\contracts\CacheInterface', function ($app) {
            return new LaravelCache($app['cache']);
        });


    }

}
