<?php namespace App\Providers;

use app\Anto\Logic\repositories\imageProcessor;
use app\Anto\Observers\adsObserver;
use app\Anto\Observers\ProductBrandObserver;
use app\Anto\Observers\ProductObserver;
use app\Anto\Observers\UserObserver;
use App\Events\UserWasRegistered;
use App\Handlers\Events\SendRegistrationEmail;
use app\Models\Ad;
use app\Models\Brand;
use app\Models\Cart;
use app\Models\Category;
use app\Models\Product;
use app\Models\SubCategory;
use app\Models\User;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'event.name' => [
            'EventListener',
        ],
        // user registration event
        UserWasRegistered::class => [
            SendRegistrationEmail::class
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

        Ad::observe(new adsObserver(new imageProcessor()));

        User::observe(new UserObserver(new imageProcessor()));
    }

}
