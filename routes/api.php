<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticatedUser;
/*

+-----------------------------------------------------+
|                 All End Points                      |               
+-----------------------------------------------------+

*/

Route::middleware([AuthenticatedUser::class])->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('logout', [LogoutController::class , 'logout']);
        Route::post('login' , [LoginController::class , 'login'])->name('login');
        Route::post('register', [SignUpController::class , 'signup']);
    });

    Route::prefix('product')->namespace('App\Http\Controllers\Product')->group(function () {
        Route::post('/add', 'AddProductController@index');
        Route::post('/delete', 'DeleteProductController@index');
        Route::post('/update', 'UpdateProductController@index');
        Route::post('/availale-pices', 'EditAvailablePicesController@index');
        Route::post('/search', 'SearchProductController@index');
        Route::get('/warnings', 'WarningsController@index');
    });

    Route::prefix('activities')->namespace('App\Http\Controllers\Activities')->group(function () {
        Route::get('/', 'ActivitiesController@index');
    });
    Route::prefix('dubt')->namespace('App\Http\Controllers\DubtControllers')->group(function () {
        Route::get('/', 'ActivitiesController@index');
    });
    Route::prefix('order')->namespace('App\Http\Controllers\Ordering')->group(function () {
        Route::get('/', 'ActivitiesController@index');
    });
});