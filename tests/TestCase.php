<?php

namespace CityHunter\LaravelMetaData\Tests;

use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

use function Orchestra\Testbench\artisan;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected $loadEnvironmentVariables = true;

    protected $enablesPackageDiscoveries  = true;

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(dirname(__DIR__) . '/core/migrations/2023_03_01_000000_laravel_meta_data_table.php');

        artisan($this, 'migrate', ['--database' => 'meta_data']);

        $this->beforeApplicationDestroyed(
            fn () => artisan($this, 'migrate:rollback', ['--database' => 'meta_data'])
        );
    }

    /*public function createApplication()
    {
        // TODO: Implement createApplication() method.
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }*/

    protected function getPackageProviders($app)
    {
        // Register any service providers from your package that need to be used in the tests
        return [
            \CityHunter\LaravelMetaData\LaravelMetaDataServiceProvider::class
        ];
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'meta_data');
        $app['config']->set('database.connections.meta_data', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Register the Eloquent factory instance in the container.
     *
     * @return void
     */
    protected function registerEloquentFactory($app)
    {
        $app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create();
        });
        $app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            return EloquentFactory::construct($faker, __DIR__ . '/../core/factories');
        });
    }
}
