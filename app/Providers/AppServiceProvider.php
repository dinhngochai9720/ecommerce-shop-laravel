<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Ho tro emojis neu version MySQL  < 5.7.7
        Schema::defaultStringLength(191);
        
        //custom phan trang su dung bootstrap
        Paginator::useBootstrap();
    }
}