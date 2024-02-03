<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\DB;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('admin', ['middleware' => 'auth', function () use ($router) {
    return $router->app->version();
}]);

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'show-time'], function () use ($router) {
        $router->get('/', 'ShowTimeController@index');
        $router->post('/create', 'ShowTimeController@store');
        $router->put('/update/{id}', 'ShowTimeController@update');
        $router->delete('/delete/{id}', 'ShowTimeController@destroy');
    });

    $router->group(['prefix' => 'chitiet'], function () use ($router) {
        $router->get('/ct', 'MoviesController@detail_index');
        $router->get('/ct/{id}', 'MoviesController@detail');
        $router->post('/ct/create', 'MoviesController@create_detail');
        $router->put('/ct/edit/{id}', 'MoviesController@update_detail');
        $router->delete('/ct/deldete/{id}', 'MoviesController@delete_detail');
    });

    $router->group(['prefix' => 'ticket'], function () use ($router) {
        $router->get('/', 'TicketController@index');
        $router->post('/create', 'TicketController@store');
        $router->put('/update/{id}', 'TicketController@update');
        $router->delete('/delete/{id}', 'TicketController@destroy');
    });
    
    $router->group(['prefix' => 'booking-history'], function () use ($router) {
        $router->get('/', 'BookingController@index');
        $router->post('/create', 'BookingController@store');
        $router->patch('/edit/{bookingID}', 'BookingController@update');
        $router->delete('/delete/{bookingID}', 'BookingController@destroy');
    });

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->post('/upload', 'AuthController@uploadImage');
    });
});

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');

