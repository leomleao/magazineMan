<?php

/* 

DEBUG AREA

*/

error_reporting(E_ALL);

$debug = new \Phalcon\Debug();
$debug->listen();

/*

How to print in console, the ChromePhp is loaded in loader.php

    ChromePhp::log('hello world');
    ChromePhp::log($_SERVER);
    ChromePhp::warn('something went wrong!');

    // using labels
    foreach ($_SERVER as $key => $value) {
        ChromePhp::log($key, $value);
    }

    // warnings and errors
    ChromePhp::warn('this is a warning');
    ChromePhp::error('this is an error');

END DEBUG AREA

*/



use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

    define('APP_PATH', realpath('..') . '/');


    /**
     *  CHECK for any missing requirement
    **/

    if (!class_exists("\\Phalcon\Version")) {
        die("Inv Manager requires the Phalcon extension to run.");
    } elseif (\Phalcon\Version::getId() < 3010240) {
        die("Inv Manager requires at least Phalcon version 3.1.2 to run.");
    } elseif (!file_exists(APP_PATH . 'app/config/config.ini')) {
        die("Configuration file missing.");
    } elseif (!file_exists(APP_PATH . 'vendor/autoload.php')) {
        die("Composer autoloader missing.");
    }

    /**
     * Read the configuration
     */
    $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
    

    $config['database']['host']     = getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost';
    $config['database']['username'] = getenv('DB_USER') ? getenv('DB_USER') : 'root';
    $config['database']['password'] = getenv('DB_PASS') ? getenv('DB_PASS') : 'root';

    /**
     * Auto-loader configuration
     */
    require APP_PATH . 'app/config/loader.php';

    $application = new Application(new Services($config));

    // NGINX - PHP-FPM already set PATH_INFO variable to handle route
    echo $application->handle(!empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null)->getContent();

