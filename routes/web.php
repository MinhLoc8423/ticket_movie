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
    
    $router->get('/show-time', 'ShowTimeController@all');

    $router->get('/ct', 'MoviesController@detail_index');
    $router->get('/ct/{id}', 'MoviesController@detail');
    $router->post('/ct', 'MoviesController@create_detail');
    $router->put('/ct/{id}', 'MoviesController@update_detail');
    $router->delete('/ct/{id}', 'MoviesController@delete_detail');

    $router->post('/ticket', 'TicketController@create');
    
    $router->get('/booking-history', 'BookingController@index');
    $router->post('/booking-history/create', 'BookingController@store');
    $router->post('/booking-history/edit', 'BookingController@update');

});
