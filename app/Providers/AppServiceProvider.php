<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('admin.shippings.form', function ($view) {
            $view->with([
                'couriers' => \App\Models\Courier::latest()->get(['id', 'name']),
                'products' => \App\Models\Product::latest()->get(['id', 'name'])
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
