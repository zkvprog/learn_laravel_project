<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \View()->composer('layout.sidebar', function(View $view) {
            $view->with('tagsCloud', \App\Models\Tag::tagsCloud());
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if('admin', function () {
            if ($user = auth()->user()) {
                return $user->isAdmin();
            }

            return false;
        });
    }
}
