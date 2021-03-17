<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant_userController;
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

Route::post('daftar1', array( 'uses' => 'Merchant_userController@store'));
Route::post('daftar2', array( 'uses' => 'Merchant_userController@store2'));
Route::post('daftar3', array('uses' => 'Merchant_userController@store3'));

