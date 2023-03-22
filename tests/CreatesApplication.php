<?php

namespace CityHunter\LaravelMetaData\Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = include __DIR__ . '/bootstrap.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
