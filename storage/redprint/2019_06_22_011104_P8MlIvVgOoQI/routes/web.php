<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::namespace('Frontend')->prefix('pages')->group(function () {
    

    // Acompanante Frontend Route
    Route::get('/acompanantes', 'AcompanantesController@index')->name('acompanante.frontend.index');


    // Tarjeta Frontend Route
    Route::get('/tarjetas', 'TarjetasController@index')->name('tarjeta.frontend.index');


    // Tarjeta Frontend Route
    Route::get('/tarjetas', 'TarjetasController@index')->name('tarjeta.frontend.index');


    // Tarjeta Frontend Route
    Route::get('/tarjetas', 'TarjetasController@index')->name('tarjeta.frontend.index');


    // Tarjeta Frontend Route
    Route::get('/tarjetas', 'TarjetasController@index')->name('tarjeta.frontend.index');


    // Cliente Frontend Route
    Route::get('/clientes', 'ClientesController@index')->name('cliente.frontend.index');


    // Cliente Frontend Route
    Route::get('/clientes', 'ClientesController@index')->name('cliente.frontend.index');


    // Cliente Frontend Route
    Route::get('/clientes', 'ClientesController@index')->name('cliente.frontend.index');
});

Route::namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/login', 'AuthController@getLogin')->name('backend.login.form');
    Route::post('/login', 'AuthController@postLogin')->name('backend.login.post');
    Route::get('/logout', 'AuthController@logout')->name('backend.logout');
});

Route::middleware(['role:admin', 'auth'])->namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard');

    // Acompanante Route
    Route::get('acompanantes', 'AcompanantesController@index')->name('acompanante.index');
    Route::get('/acompanantes/new', 'AcompanantesController@form')->name('acompanante.new');
    Route::get('/acompanantes/{acompanante}', 'AcompanantesController@form')->name('acompanante.form');
    Route::post('/acompanantes/save', 'AcompanantesController@post')->name('acompanante.save');
    Route::post('/acompanantes/{acompanante}/delete', 'AcompanantesController@delete')->name('acompanante.delete');


    // Tarjeta Route
    Route::get('tarjetas', 'TarjetasController@index')->name('tarjeta.index');
    Route::get('/tarjetas/new', 'TarjetasController@form')->name('tarjeta.new');
    Route::get('/tarjetas/{tarjeta}', 'TarjetasController@form')->name('tarjeta.form');
    Route::post('/tarjetas/save', 'TarjetasController@post')->name('tarjeta.save');
    Route::post('/tarjetas/{tarjeta}/delete', 'TarjetasController@delete')->name('tarjeta.delete');
    Route::post('/tarjetas/{tarjeta}/restore', 'TarjetasController@restore')->name('tarjeta.restore');
    Route::post('/tarjetas/{tarjeta}/force-delete', 'TarjetasController@forceDelete')->name('tarjeta.force-delete');








    // Cliente Route
    Route::get('clientes', 'ClientesController@index')->name('cliente.index');
    Route::get('/clientes/new', 'ClientesController@form')->name('cliente.new');
    Route::get('/clientes/{cliente}', 'ClientesController@form')->name('cliente.form');
    Route::post('/clientes/save', 'ClientesController@post')->name('cliente.save');
    Route::post('/clientes/{cliente}/delete', 'ClientesController@delete')->name('cliente.delete');
    Route::post('/clientes/{cliente}/restore', 'ClientesController@restore')->name('cliente.restore');
    Route::post('/clientes/{cliente}/force-delete', 'ClientesController@forceDelete')->name('cliente.force-delete');




    Route::get('/profile', 'AuthController@getProfile')->name('backend.profile');
    Route::post('/profile/save', 'AuthController@postProfile')->name('backend.profile.post');
  //ROUTES
});
// DO NOT EDIT THIS LINE
