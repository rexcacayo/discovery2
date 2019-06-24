<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Redprint Auth Route
// You can implement your own Auth endpoint and method
Route::post(
    'permissible/auth/token',
    '\Shahnewaz\Permissible\Http\Controllers\API\AuthController@postAuthenticate'
)->name('permissible.auth.token');

// API Routes
// Access them like: /api/v1/route
Route::middleware(['jwt.auth', 'role:admin'])->namespace('Backend\API')->prefix('v1/backend')->group(function () {
    //ROUTES

    // Cuestionario Route
    Route::get('cuestionarios', 'CuestionariosController@index')->name('api.cuestionario.index');
    Route::get('/cuestionarios/{cuestionario}', 'CuestionariosController@form')->name('api.cuestionario.form');
    Route::post('/cuestionarios/save', 'CuestionariosController@post')->name('api.cuestionario.save');
    Route::post('/cuestionarios/{cuestionario}/delete', 'CuestionariosController@delete')->name('api.cuestionario.delete');
    Route::post('/cuestionarios/{cuestionario}/restore', 'CuestionariosController@restore')->name('api.cuestionario.restore');
    Route::post('/cuestionarios/{cuestionario}/force-delete', 'CuestionariosController@forceDelete')->name('api.cuestionario.force-delete');

});
