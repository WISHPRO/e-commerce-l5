<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EnvironmentServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->app->runningInConsole()) return;
		\Dotenv::required(
			[
				'DB_HOST',
				'DB_DATABASE',
				'DB_USERNAME',
				'DB_PASSWORD',
				'IMAGES_DIR'
			]
		);
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
