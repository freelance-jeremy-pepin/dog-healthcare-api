<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// API route group
use Laravel\Lumen\Routing\Router;

// Protected routes
$router->group(
    [
        'prefix' => 'api',
        // 'middleware' => 'auth' // TODO:
    ],
    function () use ($router) {

        // User
        $router->group(
            ['prefix' => 'user'],
            function () use ($router) {
                // Matches "/api/user/me
                $router->get('me', 'UserController@getMe');

                // Matches "/api/user/1
                $router->get('{id}', 'UserController@getById');

                // Matches "/api/user
                $router->get('', 'UserController@getAll');
            }
        );

        // Dog
        $router->group(
            ['prefix' => 'dog'],
            function () use ($router) {
                // Matches "/api/dog/1
                $router->get('{id}', 'DogController@getById');

                // Matches "/api/dog
                $router->get('', 'DogController@getAll');
            }
        );
    }
);

// Unprotected routes
$router->group(
    [
        'prefix' => 'api',
    ],
    function () use ($router) {
        // Matches "/api/register
        $router->post('register', 'AuthController@register');

        // Matches "/api/login
        $router->post('login', 'AuthController@login');
    }
);
