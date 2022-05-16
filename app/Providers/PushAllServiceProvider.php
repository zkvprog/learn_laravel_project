<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\PushAll\PushAllSelf::class, function () {
            return new \App\Services\PushAll\PushAllSelf(config('custom.pushall.api_key'), config('custom.pushall.api_id'));
        });

        $this->app->singleton(\App\Services\PushAll\PushAllBroadcast::class, function () {
            return new \App\Services\PushAll\PushAllBroadcast(config('custom.pushall.api_channel_key'), config('custom.pushall.api_channel_id'));
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
    }
}
