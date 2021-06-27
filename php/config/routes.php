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

    // $app->post('/jwt', \App\Action\Jwt\JwtTokenReCreateAction::class);
    /**
     * Protected Area only accessible with JWT
     */
    $app->group('', function (RouteCollectorProxy $group) use($app) {
       
        $group->post('/jwt', \App\Action\Jwt\JwtTokenReCreateAction::class);

        $group->group('/location', function (RouteCollectorProxy $group) {
            $group->post('/add', \App\Action\Location\LocationCreateAction::class);
        });

        /**
         * Admin Or Manager
         */
        $group->group('', function (RouteCollectorProxy $group) {
            
        })    
        ->add(\App\Middleware\AdminOrManagerMiddleware::class);

        /**
         *  Super Admin area
         */
        $group->group('', function (RouteCollectorProxy $group) {
                            
        })
        ->add(\App\Middleware\SuperAdminMiddleware::class);
        
    })->add(\App\Middleware\JwtMiddleware::class);

};