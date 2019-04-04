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
$router->get('/farmers/{farmer_info}', 'FarmerInfoController@show');
$router->put('/test/{farmer_info)', 'FarmerInfoController@update'); //TODO: Currently not working
$router->patch('/farmers/{farmer_info}', 'FarmerInfoController@update');
$router->delete('/farmers/{farmer_info}', 'FarmerInfoController@destroy');

$router->patch('/farmers/{farmer_info}/bank-info', 'BankInfoController@update');



