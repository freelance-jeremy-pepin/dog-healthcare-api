<?php


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


$api = app('Dingo\Api\Routing\Router');

$api->version(
    'v1',
    function ($api) {
        // Protected routes
        $api->group(
            [
                'prefix' => 'api',
                // 'middleware' => 'auth' // TODO:
            ],
            function () use ($api) {

                // User
                $api->group(
                    ['prefix' => 'user'],
                    function () use ($api) {
                        // Matches "/api/user/me
                        $api->get('me', 'App\Http\Controllers\UserController@getMe');

                        // Matches "/api/user/1
                        $api->get('{id}', 'App\Http\Controllers\UserController@getById');

                        // Matches "/api/user
                        $api->get('', 'App\Http\Controllers\UserController@getAll');
                    }
                );

                // Dog
                $api->group(
                    ['prefix' => 'dog'],
                    function () use ($api) {
                        // Matches "GET /api/dog/1
                        $api->get('{id}', 'App\Http\Controllers\DogController@getById');

                        // Matches "GET /api/dog
                        $api->get('', 'App\Http\Controllers\DogController@getAll');

                        // Matches "POST /api/dog
                        $api->post('', 'App\Http\Controllers\DogController@create');

                        // Matches "PUT /api/dog/1
                        $api->put('{id}', 'App\Http\Controllers\DogController@update');

                        // Matches "DELETE /api/dog/1
                        $api->delete('{id}', 'App\Http\Controllers\DogController@delete');
                    }
                );
            }
        );

        // Unprotected routes
        $api->group(
            [
                'prefix' => 'api',
            ],
            function () use ($api) {
                // Matches "/api/register
                $api->post('register', 'App\Http\Controllers\AuthController@register');

                // Matches "/api/login
                $api->post('login', 'App\Http\Controllers\AuthController@login');
            }
        );

    }
);

