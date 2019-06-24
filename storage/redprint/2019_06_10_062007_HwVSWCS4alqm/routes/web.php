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
