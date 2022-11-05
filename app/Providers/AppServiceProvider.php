<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
           
            //  view()->composer('*', function($view){
            // $master_abouts = About::orderBy('id', 'ASC')->get();
            // $view->with('master_abouts', $master_abouts);
            //         });
            //     view()->composer('*', function($view){
            // $master_categories = Category::orderBy('id', 'ASC')->get();
            // $view->with('master_categories', $master_categories);
            //         });
    }
}
