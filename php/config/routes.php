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
    
    $app->group('/server', function (RouteCollectorProxy $group) {
        $group->group('/location', function (RouteCollectorProxy $group) {
            $group->get('/{id}', \App\Action\Location\LocationReadAction::class);
        });
        $group->group('/locations', function (RouteCollectorProxy $group) {
            $group->get('/search', \App\Action\Location\LocationsSearchAction::class);
            $group->get('/search/all', \App\Action\Location\LocationsAllAction::class);
            $group->get('/search/city/{city}[/{page:[0-9]+}]', \App\Action\Location\LocationCitiesSearchAction::class);
        });
    })->add(\App\Middleware\ServerMiddleware::class);
    
    $app->group('/public', function (RouteCollectorProxy $group) {

    });

    /**
     * Protected Area only accessible with JWT
     */
    $app->group('', function (RouteCollectorProxy $group) use($app) {
       
        $group->post('/jwt', \App\Action\Jwt\JwtTokenReCreateAction::class);

        $group->group('/location', function (RouteCollectorProxy $group) {
            $group->post('/add', \App\Action\Location\LocationCreateAction::class)->add(\App\Middleware\ApiRateLimitMiddleware::class);
            // $group->get('/{id}', \App\Action\Location\LocationReadAction::class);
            $group->post('/{id}/update', \App\Action\Location\LocationUpdateAction::class)->add(\App\Middleware\ApiRateLimitMiddleware::class);
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