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

$router->get('/farmers', 'FarmerInfoController@index');
$router->post('/farmers', 'FarmerInfoController@store');
$router->get('/farmers/$id', 'FarmerInfoController@show');
$router->put('/farmers/$id', 'FarmerInfoController@update');
$router->patch('/farmers/$id', 'FarmerInfoController@update');
$router->delete('/farmers/$id', 'FarmerInfoController@destroy');

