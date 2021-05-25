<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
 *  API VERSION 1
 */

$router->group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function () use ($router) {
	$router->post('auth/register', 'Auth\AuthController@register');
});

$router->group(['prefix' => 'api/v1', 'namespace' => 'Api\V1', 'middleware' => ['auth']], function () use ($router) {
    $router->get('auth/me', 'Auth\AuthController@me');
    $router->post('auth/updateProfile', 'Auth\AuthController@updateProfile');
    $router->post('auth/setAvatar', 'Auth\AuthController@setAvatar');
    $router->post('auth/setCover', 'Auth\AuthController@setCover');

    $router->get('posts', 'PostsController@index');
    $router->post('posts', 'PostsController@store');
    $router->get('posts/byUser/{user_id}', 'PostsController@byUser');
    $router->post('posts/like/{post_id}', 'PostsController@like');
    $router->post('posts/comment/{post_id}', 'PostsController@comment');

    $router->post('search', 'SearchController@index');

    $router->get('profile/{user_id}', 'ProfileController@byUser');

    $router->get('users/follow/{user_id}', 'UsersController@follow');

    $router->get('auth/logout', 'Auth\AuthController@logout');
});

/*
 *  API VERSION 2
 */
$router->group(['prefix' => 'api/v2', 'namespace' => 'Api\V2'], function () use ($router) {
    $router->post('auth/register', 'Auth\AuthController@register');
    $router->get('/cep/{cep}', 'CepController@show');
});

$router->group(['prefix' => 'api/v2', 'namespace' => 'Api\V2', 'middleware' => ['auth']], function () use ($router) {
    $router->get('auth/me', 'Auth\AuthController@me');
    $router->post('auth/updateProfile', 'Auth\AuthController@updateProfile');
    $router->post('auth/setAvatar', 'Auth\AuthController@setAvatar');
    $router->post('auth/setCover', 'Auth\AuthController@setCover');
    $router->get('auth/logout', 'Auth\AuthController@logout');

    $router->get('/vehicles/{vehicle_type}/brand', 'VehiclesController@brand');
    $router->get('/vehicles/{vehicle_type}/{vehicle_brand}/model', 'VehiclesController@model');
    $router->get('/vehicles/{vehicle_brand}/{vehicle_model}/version', 'VehiclesController@version');

    $router->post('/vehicles_images/upload', 'VehicleImagesController@upload');

    $router->get('/getcombo', 'VehiclesController@getCombo');

    $router->get('/vehicles', 'VehiclesController@index');
    $router->post('/vehicles', 'VehiclesController@store');
    $router->get('/vehicles/{id}', 'VehiclesController@show');
    $router->put('/vehicles/{id}', 'VehiclesController@update');
    $router->delete('/vehicles/{id}', 'VehiclesController@destroy');

});