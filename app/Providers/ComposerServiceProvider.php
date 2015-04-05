<?php namespace App\Providers;

use App\Models\Cart;
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
            'App\Http\ViewComposers\ShoppingCart' => ['frontend.*', 'auth.*'],
            'App\Http\ViewComposers\TopProducts' => ['frontend.index'],
            'App\Http\ViewComposers\NewProducts' => ['frontend.index'],
            'App\Http\ViewComposers\FeaturedLaptops' => ['frontend.index', 'frontend.Cart.*'],
            'App\Http\ViewComposers\FeaturedTablets' => ['frontend.index', 'frontend.Cart.*'],
            //'App\Http\ViewComposers\HomePageSlider' => ['frontend.index'],
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