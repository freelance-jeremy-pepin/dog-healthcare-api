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

                // Anti-parasitic
                $api->group(
                    ['prefix' => 'anti-parasitic'],
                    function () use ($api) {
                        // Matches "GET /api/anti-parasitic/1
                        $api->get('{id}', 'App\Http\Controllers\AntiParasiticController@getById');

                        // Matches "GET /api/anti-parasitic
                        $api->get('', 'App\Http\Controllers\AntiParasiticController@getAll');

                        // Matches "POST /api/anti-parasitic
                        $api->post('', 'App\Http\Controllers\AntiParasiticController@create');

                        // Matches "PUT /api/anti-parasitic/1
                        $api->put('{id}', 'App\Http\Controllers\AntiParasiticController@update');

                        // Matches "DELETE /api/anti-parasitic/1
                        $api->delete('{id}', 'App\Http\Controllers\AntiParasiticController@delete');
                    }
                );

                // Deworming
                $api->group(
                    ['prefix' => 'deworming'],
                    function () use ($api) {
                        // Matches "GET /api/deworming/1
                        $api->get('{id}', 'App\Http\Controllers\DewormingController@getById');

                        // Matches "GET /api/deworming
                        $api->get('', 'App\Http\Controllers\DewormingController@getAll');

                        // Matches "POST /api/deworming
                        $api->post('', 'App\Http\Controllers\DewormingController@create');

                        // Matches "PUT /api/deworming/1
                        $api->put('{id}', 'App\Http\Controllers\DewormingController@update');

                        // Matches "DELETE /api/deworming/1
                        $api->delete('{id}', 'App\Http\Controllers\DewormingController@delete');
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

                // Professional
                $api->group(
                    ['prefix' => 'professional'],
                    function () use ($api) {
                        // Matches "GET /api/professional/1
                        $api->get('{id}', 'App\Http\Controllers\ProfessionalController@getById');

                        // Matches "GET /api/professional
                        $api->get('', 'App\Http\Controllers\ProfessionalController@getAll');

                        // Matches "POST /api/professional
                        $api->post('', 'App\Http\Controllers\ProfessionalController@create');

                        // Matches "PUT /api/professional/1
                        $api->put('{id}', 'App\Http\Controllers\ProfessionalController@update');

                        // Matches "DELETE /api/professional/1
                        $api->delete('{id}', 'App\Http\Controllers\ProfessionalController@delete');
                    }
                );

                // ProfessionalType
                $api->group(
                    ['prefix' => 'professional-type'],
                    function () use ($api) {
                        // Matches "GET /api/professional-type/1
                        $api->get('{id}', 'App\Http\Controllers\ProfessionalTypeController@getById');

                        // Matches "GET /api/professional-type
                        $api->get('', 'App\Http\Controllers\ProfessionalTypeController@getAll');

                        // Matches "POST /api/professional-type
                        $api->post('', 'App\Http\Controllers\ProfessionalTypeController@create');

                        // Matches "PUT /api/professional-type/1
                        $api->put('{id}', 'App\Http\Controllers\ProfessionalTypeController@update');

                        // Matches "DELETE /api/professional-type/1
                        $api->delete('{id}', 'App\Http\Controllers\ProfessionalTypeController@delete');
                    }
                );

                // Reminder
                $api->group(
                    ['prefix' => 'reminder'],
                    function () use ($api) {
                        // Matches "GET /api/reminder/1
                        $api->get('{id}', 'App\Http\Controllers\ReminderController@getById');

                        // Matches "GET /api/reminder
                        $api->get('', 'App\Http\Controllers\ReminderController@getAll');

                        // Matches "POST /api/reminder
                        $api->post('', 'App\Http\Controllers\ReminderController@create');

                        // Matches "PUT /api/reminder/1
                        $api->put('{id}', 'App\Http\Controllers\ReminderController@update');

                        // Matches "DELETE /api/reminder/1
                        $api->delete('{id}', 'App\Http\Controllers\ReminderController@delete');
                    }
                );

                // Weight
                $api->group(
                    ['prefix' => 'weight'],
                    function () use ($api) {
                        // Matches "GET /api/weight/1
                        $api->get('{id}', 'App\Http\Controllers\WeightController@getById');

                        // Matches "GET /api/weight
                        $api->get('', 'App\Http\Controllers\WeightController@getAll');

                        // Matches "POST /api/weight
                        $api->post('', 'App\Http\Controllers\WeightController@create');

                        // Matches "PUT /api/weight/1
                        $api->put('{id}', 'App\Http\Controllers\WeightController@update');

                        // Matches "DELETE /api/weight/1
                        $api->delete('{id}', 'App\Http\Controllers\WeightController@delete');
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

