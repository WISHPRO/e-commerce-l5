<?php namespace App\Providers;

use app\Models\Cart;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // all composers
        View::composers([
            'App\Http\ViewComposers\CategoryList' => ['layouts.frontend.master'],
            'App\Http\ViewComposers\BrandsList' => ['layouts.frontend.master'],
            'App\Http\ViewComposers\ShoppingCart' => ['frontend.*'],
            'App\Http\ViewComposers\TopProducts' => ['frontend.index'],
            'App\Http\ViewComposers\NewProducts' => ['frontend.index'],
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}