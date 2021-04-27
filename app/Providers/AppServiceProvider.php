<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Meet;
use App\Models\Room;
use View;

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
        $meetCount = count(Meet::all());
        $roomCount = count(Room::all());
        View::share('meetCount', $meetCount);
        View::share('roomCount', $roomCount);
    }
}
