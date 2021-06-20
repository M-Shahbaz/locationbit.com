<?php

use App\Domain\Jwt\Service\JwtAuth;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\RouteCollectorInterface;

use Psr\Log\LoggerInterface;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use \Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;
return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Optional: Set the base path to run the app in a sub-directory
        // The public directory must not be part of the base path
        $app->setBasePath('/api');

        return $app;
    },

    RouteCollectorInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector();
    },

    LoggerInterface::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);

        $name = $config->getString('logger.name');
        $path = $config->getString('logger.path');
        $level = $config->getString('logger.level');
        
        $logger = new Logger($name);
        $handler = new StreamHandler($path, (int)$level);
        $logger->pushHandler($handler);

        return $logger;
    },

    // Database connection
    Connection::class => function (ContainerInterface $container) {
        $factory = new ConnectionFactory(new IlluminateContainer());

        $connection = $factory->make($container->get(Configuration::class)->getArray('db'));

        // Disable the query log to prevent memory issues
        $connection->disableQueryLog();

        return $connection;
    },

    PDO::class => function (ContainerInterface $container) {
        return $container->get(Connection::class)->getPdo();
    },

    // twig
    Environment::class => function (ContainerInterface $container): Environment {
        $loader = new FilesystemLoader([__DIR__ . '/../templates/', __DIR__ . '/../templates/emails']);
        $twig = new Environment($loader, [
            __DIR__ . '/../cache'
        ]);

        $twig->addGlobal('COMPANY_NAME', getenv('COMPANY_NAME'));
        $twig->addGlobal('COMPANY_NAME_SHORT', getenv('COMPANY_NAME_SHORT'));
        $twig->addGlobal('COMPANY_HR_NUMBER', getenv('COMPANY_HR_NUMBER'));
        $twig->addGlobal('COMPANY_WEBSITE', getenv('COMPANY_WEBSITE'));
        $twig->addGlobal('COMPANY_WEBSITE_URL', getenv('COMPANY_WEBSITE_URL'));
        $twig->addGlobal('COMPANY_PHONENUMBER_CLI', getenv('COMPANY_PHONENUMBER_CLI'));
        $twig->addGlobal('COMPANY_PHONENUMBER_DISPLAY', getenv('COMPANY_PHONENUMBER_DISPLAY'));
        $twig->addGlobal('COMPANY_ADDRESS', getenv('COMPANY_ADDRESS'));
        $twig->addGlobal('COMPANY_EMAIL_INFO', getenv('COMPANY_EMAIL_INFO'));

        $twig->enableDebug();
        return $twig;
    },

    
    // Add this entry
    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },
    
    // And add this entry
    JwtAuth::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);

        $issuer = $config->getString('jwt.issuer');
        $lifetime = $config->getInt('jwt.lifetime');
        $privateKey = $config->getString('jwt.private_key');
        $publicKey = $config->getString('jwt.public_key');
        
        return new JwtAuth($issuer, $lifetime, $privateKey, $publicKey);
    },

];