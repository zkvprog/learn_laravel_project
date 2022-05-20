<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PushAll\PushAllSelf;
use App\Services\PushAll\PushAllBroadcast;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PushAllSelf::class, function () {
            return new PushAllSelf(config('custom.pushall.api_key'), config('custom.pushall.api_id'));
        });

        $this->app->singleton(PushAllBroadcast::class, function () {
            return new PushAllBroadcast(config('custom.pushall.api_channel_key'), config('custom.pushall.api_channel_id'));
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
