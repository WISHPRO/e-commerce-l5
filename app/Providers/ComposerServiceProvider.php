<?php namespace App\Providers;

use app\Models\Cart;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // home page
        $this->app->view->composer(
            'layouts.frontend.master',
            'app\Anto\Composers\CategoryListComposer'
        );
        $this->app->view->composer(
            'frontend.index',
            'app\Anto\Composers\TopProductsComposer'
        );
        $this->app->view->composer(
            'frontend.index',
            'app\Anto\Composers\NewProductsComposer'
        );
        $this->app->view->composer(
            'layouts.frontend.master',
            'app\Anto\Composers\BrandsListComposer'
        );
        // shopping cart
        $this->app->view->composer(
            ['layouts.frontend.master', 'frontend.Cart.products'],
            'app\Anto\Composers\ShoppingCartComposer'
        );


    }

}