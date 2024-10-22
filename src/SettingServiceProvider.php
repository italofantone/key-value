<?php

namespace Italofantone\Setting;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('setting.manager', function () {
            return new Setting();
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }    
}