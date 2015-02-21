<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FunctionsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            return;
        }
        require_once app_path() . '/Anto/Functions/all.php';
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
