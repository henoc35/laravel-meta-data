<?php

namespace CityHunter\LaravelMetaData;

use Illuminate\Support\ServiceProvider;

class LaravelMetaDataServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $base = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core';

        $this->publishes([
            $base . '/config/meta_data.php' => config_path('meta_data.php')
        ], 'config');

        $this->publishes([
            $base . '/migrations/2023_03_01_000000_laravel_meta_data_table.php' => database_path(
                'migrations/' . date('Y_m_d_His') . '_laravel_meta_data_table.php'
            ),
        ], 'migrations');
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core/config/meta_data.php', 'meta_data');
    }
}
