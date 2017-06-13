<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    APP_PATH . $config->application->controllersDir,
    APP_PATH . $config->application->pluginsDir,
    APP_PATH . $config->application->libraryDir,
    APP_PATH . $config->application->modelsDir
])->register();

$loader->registerClasses([
    'Services' 		=> APP_PATH . 'app/config/services.php',
    'JsonResponse'  => APP_PATH . 'app/util/JsonResponse.php',
    'JsonData'  	=> APP_PATH . 'app/util/JsonData.php',
    'JsonException' => APP_PATH . 'app/util/JsonException.php',
    'UUID' 			=> APP_PATH . 'app/util/UUID.php',
    'ChromePhp'     => APP_PATH . 'app/util/ChromePhp.php'
]);

require_once APP_PATH . '/vendor/autoload.php';

