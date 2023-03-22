<?php

date_default_timezone_set('UTC');

// Enable Composer autoloader
/** @var \Composer\Autoload\ClassLoader $autoloader */
$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';

// Register test classes
$autoloader->addPsr4('CityHunter\\LaravelMetaData\\', dirname(__DIR__) . "/src");
$autoloader->addPsr4('CityHunter\\LaravelMetaData\\Tests\\', __DIR__);
