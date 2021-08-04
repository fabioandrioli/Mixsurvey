<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/dashboard', function () {
//     return view('dashboard.dashboard');
// });

// Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:api'],function(){
//     Route::get('dash', function () {
//         return view('dashboard.dashboard');
//     });
// });


Route::get('/resultsShow/{id}','SiteController@resultsSession');
Route::post('/option/search','SiteController@search');



