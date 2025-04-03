<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Установка локализации для Carbon
        Carbon::setLocale('ru');

        // Установка часового пояса
        date_default_timezone_set('Asia/Vladivostok');
    }
}
