<?php

use Dotenv\Dotenv;
use Monolog\Logger;

// Error reporting
if(!APP_DEBUG_MODE){
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Timezone
date_default_timezone_set(TIME_ZONE);

//. envoirement
$dotenv = Dotenv::createUnsafeImmutable(__DIR__ .'/../../');
$dotenv->load();
$dotenv->required('DB_NAME')->notEmpty();
$dotenv->required('DB_USER')->notEmpty();
$dotenv->required('DB_PASS')->notEmpty();

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = TEMP_FOLDER;
$settings['public'] = PUBLIC_FOLDER;

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [

    // Should be set to false in production
    'display_error_details' => APP_DEBUG_MODE,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => APP_LOG_ERRORS,

    // Display error details in error log
    'log_error_details' => APP_LOG_ERRORS,
];

// Logger
$settings['logger'] = [
    'name' => getenv('APP_NAME'),
    'path' => 'php://stderr',
    'level' => Logger::DEBUG,
];

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

//jwt token rsa keys
$settings['jwt'] = [
    // The issuer name
    'issuer' => getenv('JWT_ISSUER'),
    // Max lifetime in seconds
    'lifetime' => 14400,
    // The private key
    'private_key' => getenv('JWT_PRIVATE_KEY'),
    'public_key' => getenv('JWT_PUBLIC_KEY'),
];


return $settings;