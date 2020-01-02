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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'mahasiswas'], function () {
    Route::get('', 'MahasiswaController@index');
    Route::post('', 'MahasiswaController@create');
    Route::post('/{id}/edit', 'MahasiswaController@update');
    Route::delete('/{id}', 'MahasiswaController@delete');
});

Route::group(['prefix' => 'jurusans'], function () {
    Route::get('', 'JurusanController@index');
    Route::post('', 'JurusanController@create');
    Route::post('/{id}/edit', 'JurusanController@update');
    Route::delete('/{id}', 'JurusanController@delete');
});
