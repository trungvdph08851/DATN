<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Services;
use App\Models\CategoryArticle;
use App\Models\setting_system;
use Illuminate\Support\Facades\View;
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
         $services = Services::all();
         $categories = CategoryArticle::all();
         $setting = setting_system::where('status',1)->first();
         View::share(['servicess' => $services,'setting'=>$setting,'categories'=>$categories]);
    }
}
//quang
