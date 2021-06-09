<?php

use App\Utility\IpService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Selective\Config\Configuration;
use App\Utility\FunctionsService;
use Psr\Http\Server\RequestHandlerInterface;

use Slim\App;

return function (App $app) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add routing middleware
    $app->addRoutingMiddleware();

    $container = $app->getContainer();
    $settings = $container->get(Configuration::class)->getArray('error_handler_middleware');

    $app->add(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
        // Convert array to object
        $request = $request->withAttribute('token', (object)$request->getAttribute("token"));

        return $handler->handle($request);
    });

    $app->add(new \Tuupola\Middleware\JwtAuthentication([
        "secret" => getenv("JWT_PUBLIC_KEY"),
        "algorithm" => getenv("JWT_ALGORITHM"),
        "ignore" => APP_PASSTHROUGH_HOSTS,
        "relaxed" => APP_DEBUG_MODE ? APP_RELAXED_HOSTS : [],
        "path" => "/",
        /* "before" => function ($request, $arguments) {
            //$container['logger'] -> do logging here
            //container["token"]->populate($arguments["decoded"]);
     }, */
        "before" => function (ServerRequestInterface $request, $arguments) {
            //check jwt and resource access in: JwtMiddleware.php
        },
        "error" => function ($response, $arguments) {
            $response->getBody()->write((string)json_encode($arguments["message"]));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus($statusCode ?? 401);
        }
    ]));

    // Add error handler middleware
    $displayErrorDetails = (bool)$settings['display_error_details'];
    $logErrors = (bool)$settings['log_errors'];
    $logErrorDetails = (bool)$settings['log_error_details'];


    $errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);

    // Define Custom Error Handler
    $customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $logger = null
    ) use ($app) {

        $statusCode = !empty($exception->getCode()) ? $exception->getCode() : 500;
        $response = $app->getResponseFactory()->createResponse()->withStatus($statusCode);

        return $response;
    };

    //Nothing to display if IP no in APP_DEV_MODE_IPS
    if (!in_array(IpService::getUserIP(), APP_DEV_MODE_IPS)) {
        $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
    }
};
