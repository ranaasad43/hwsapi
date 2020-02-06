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

// $router->get('/', function () use ($router) {
//     //return $router->app->version();
//     echo "hello";
// });
//$router->group(['middleware' => ['apiAuth']],function() use ($router){
	$router->post('/adduser','UsersController@addUser');
	$router->get('/users','UsersController@getUsers');
	$router->get('/user/{id}','UsersController@getUser');
	$router->delete('/user/{id}','UsersController@destroyUser');
	$router->put('/user/{id}','UsersController@updateUser');
	$router->get('/userLogin','UsersController@login');
	$router->get('/genres','GenresController@getGenres');
	$router->get('/studios','StudiosController@getStudios');
	//$router->get('/addfilm','FilmsController@addFilm');
	$router->post('/addfilm','FilmsController@addFilm');
//});
