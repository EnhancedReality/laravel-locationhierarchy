<?php

namespace EnhancedReality\LocationHierarchy\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Foundation\Testing\RefreshDatabase;

use EnhancedReality\LocationHierarchy\{Community,Municipality,Region,LocationServiceProvider};

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LocationServiceProvider::class,
        ];
    }

    public function setUp()
    {
        parent::setUp();

        // $this->artisan('migrate');
        // dd(realpath(__DIR__.'/../src/database/migrations'));
        $this->loadMigrationsFrom(realpath(__DIR__.'/database/migrations'));
        $this->loadMigrationsFrom(realpath(__DIR__.'/../src/database/migrations'));
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite_testing');
        $dbConfig = [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ];
        $app['config']->set('database.connections.sqlite_testing', $dbConfig);
    }

}