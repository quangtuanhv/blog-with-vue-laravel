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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'V1\Api'], function () {
    Route::prefix('post')->group(base_path('routes/api/post.php'));
    Route::group(['namespace'=>'Auth'], function () {
        Route::prefix('auth')->group(base_path('routes/api/auth.php'));
    });    
});
