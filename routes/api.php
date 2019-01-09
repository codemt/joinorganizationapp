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

Route::post('importExcel','Website@importExcel')->name('importExcel');

Route::post('assign_khanp','Website@assign_khanp')->name('assign_khanp');

Route::post('assign_region','Website@assign_region')->name('assign_region');

Route::post('update_member','Website@update_member')->name('update_member');