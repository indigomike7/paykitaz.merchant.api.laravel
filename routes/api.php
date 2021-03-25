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

Route::post('daftar', array( 'uses' => 'Merchant_userController@store'));
Route::post('daftar2', array( 'uses' => 'Merchant_userController@store2'));
Route::post('daftar3', array('uses' => 'Merchant_userController@store3'));
Route::post('login', array( 'uses' => 'Merchant_userController@login'));
Route::post('checkloginredirect', array( 'uses' => 'Merchant_userController@checkLoginRedirect'));



Route::post('province', array('uses' => 'ProvinceController@store'));
Route::post('kabupaten', array('uses' => 'KabupatenController@store'));
Route::post('kecamatan', array('uses' => 'KecamatanController@store'));
Route::post('kelurahan', array('uses' => 'KelurahanController@store'));

Route::post('businesstype', array('uses' => 'BusinessTypeController@store'));
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

