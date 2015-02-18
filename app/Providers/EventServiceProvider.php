<?php namespace App\Providers;

use app\Anto\CustomClasses\CategoryObserver;
use app\Anto\CustomClasses\ProductBrandObserver;
use app\Anto\CustomClasses\ProductObserver;
use app\Anto\CustomClasses\SubCategoryObserver;
use app\Anto\CustomClasses\UserObserver;
use app\Models\Brand;
use app\Models\Category;
use app\Models\Product;
use app\Models\SubCategory;
use app\Models\User;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		// register custom model observers
		Product::observe(new ProductObserver());
		Brand::observe(new ProductBrandObserver());
		Category::observe(new CategoryObserver());
		SubCategory::observe(new SubCategoryObserver());
		User::observe(new UserObserver());
	}

}
