<?php

use Slim\Routing\RouteCollectorProxy;
use Slim\App;

return function (App $app) {
 
    /**
     * Public area
     */

    if (APP_DEBUG_MODE) {
        /*V2 this is to test different services */
        $app->map(['GET', 'POST'], '/test[/{id}]', \App\Action\TestAction::class);
    }

    /**
     * Protected Area only accessible with JWT
     */
    $app->group('', function (RouteCollectorProxy $group) use($app) {
       
    
        /**
         * Admin Or Manager
         */
        $app->group('', function (RouteCollectorProxy $group) {
            
        })    
        ->add(\App\Middleware\AdminOrManagerMiddleware::class);

        /**
         *  Super Admin area
         */
        $app->group('', function (RouteCollectorProxy $group) {
                            
        })
        ->add(\App\Middleware\SuperAdminMiddleware::class);
        
    })->add(\App\Middleware\JwtMiddleware::class);

};