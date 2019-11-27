<?php
namespace frankyso\OnePush;

use Illuminate\Support\ServiceProvider;
use frankyso\OnePush\OnePush;

class OnePushServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('OnePush',function(){
            return new OnePush();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/onepush.php' => config_path('onepush.php'),
        ]);
    }
}
