<?php

namespace Italofantone\Setting\Tests;

use Italofantone\Setting\SettingServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->app->register(SettingServiceProvider::class);
    }
}