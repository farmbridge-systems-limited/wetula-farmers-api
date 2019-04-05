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

// FARMERS
$router->get('/farmers', 'FarmerInfoController@index');
$router->post('/farmers', 'FarmerInfoController@store');
$router->get('/farmers/{farmer_info}', 'FarmerInfoController@show');
$router->put('/farmers/{farmer_info)', 'FarmerInfoController@update'); //TODO: Currently not working
$router->patch('/farmers/{farmer_info}', 'FarmerInfoController@update');
$router->delete('/farmers/{farmer_info}', 'FarmerInfoController@destroy');

// BANK INFORMATION
$router->get('/farmers/{farmer_info}/bank-info', 'BankInfoController@show');
$router->patch('/farmers/{farmer_info}/bank-info', 'BankInfoController@update');
$router->delete('/farmers/bank-info{bank_info}', 'BankInfoController@destroy');

// LANDs
$router->get('/farmers/{farmer_info}/land/{land}', 'LandController@show');
$router->patch('/farmers/{farmer_info}/land/{land}', 'LandController@update');
$router->delete('/farmers/lands{land}', 'LandController@destroy');

// LAND DOCUMENTS
$router->get('/farmers/lands/{land}/document/{document}', 'LandDocumentsController@show');
$router->patch('/farmers/lands/{land}/document/{document}', 'LandDocumentsController@update');
$router->delete('/farmers/documents/{document}', 'LandController@destroy');



