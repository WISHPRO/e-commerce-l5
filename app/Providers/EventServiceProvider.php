<?php namespace App\Providers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Anto\Observers\CartObserver;
use app\Anto\Observers\CategoryObserver;
use app\Anto\Observers\ProductBrandObserver;
use app\Anto\Observers\ProductObserver;
use app\Anto\Observers\SubCategoryObserver;
use app\Anto\Observers\UserObserver;
use app\Models\Brand;
use app\Models\Cart;
use app\Models\Category;
use app\Models\Product;
use app\Models\SubCategory;
use app\Models\User;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Mailer;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen
        = [
            'event.name' => [
                'EventListener',
            ],
        ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        // register custom model observers
        Product::observe(new ProductObserver(new imageProcessor()));
        Brand::observe(new ProductBrandObserver(new imageProcessor()));
        Category::observe(new CategoryObserver(new imageProcessor()));
        SubCategory::observe(new SubCategoryObserver());
        //User::observe(new UserObserver(new \Mail(), new imageProcessor()));
        Cart::observe(new CartObserver());
    }

}
