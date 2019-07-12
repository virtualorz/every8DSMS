<?php

namespace Virtualorz\Every8DSMS;

use Illuminate\Support\ServiceProvider;

class Every8DSMSServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('every8DSMS',function(){
            return new Every8DSMS();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/config' => base_path('config'),
        ]);
    }
}
