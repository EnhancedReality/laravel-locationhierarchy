<?php

namespace EnhancedReality\LocationHierarchy;

use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {

    }
}