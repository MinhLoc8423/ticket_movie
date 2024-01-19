<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Http\Controllers\ProductDetailController;

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/show-time', function () use ($router) {
        $results = DB::select("SELECT showtime.showtime_id, movies.movie_title, cinema.name, showtime.time FROM showtime, movies, cinema WHERE showtime.cinema_id = cinema.cinema_id AND showtime.movie_id = movies.movie_id");
        return $results;
    });

    $router->get('/ct/{id}', 'MoviesController@detail');
});
