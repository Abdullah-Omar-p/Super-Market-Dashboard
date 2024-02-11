<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticatedUser;
/*

+----------------------------------------------------+
|        -         All End Points         -          |               
+----------------------------------------------------+

*/

Route::middleware([AuthenticatedUser::class])->group(function () {

    Route::prefix('auth')->namespace('App\Http\Controllers\AuthControllers')->group(function () {
        // dd(SignUpController::class);
        Route::post('logout', 'LogoutController@logout');
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register','SignUpController@signup');
    })->withoutMiddleware([AuthenticatedUser::class]);

    Route::prefix('product')->namespace('App\Http\Controllers\Product')->group(function () {
        Route::post('/add', 'AddProductController@index');
        Route::post('/delete', 'DeleteProductController@index');
        Route::post('/update', 'UpdateProductController@index');
        Route::get('/search-barcode', 'SearchBarCodeOrNameController@index'); // .. pass only the barcode no ..
        Route::get('/search-name', 'SearchBarCodeOrNameController@index');    // .. pass only the name ..
        Route::post('/availale-pices', 'EditAvailablePicesController@index');
        Route::post('/search', 'SearchProductController@index');
        Route::get('/warnings', 'WarningsController@index');
    });

    Route::prefix('activities')->namespace('App\Http\Controllers\Activities')->group(function () {
        Route::get('/', 'ActivitiesController@index');
    });
    Route::prefix('dubt')->namespace('App\Http\Controllers\DubtControllers')->group(function () {
        Route::post('/add', 'AddLiabilityController@index');
        Route::post('/update', 'EditDubtController@index');
        Route::post('/delete', 'DeleteDubtController@index');
        Route::get('/for-you/{status?}', 'GetDubtController@index')->where('status', 1);
        Route::get('/for-others/{status?}', 'GetDubtController@index')->where('status', 0);
    });
    Route::prefix('order')->namespace('App\Http\Controllers\Ordering')->group(function () {
        Route::post('/', 'MakeOrderController@index');
    });
    Route::prefix('statistics')->namespace('App\Http\Controllers\Statistics')->group(function () {
        Route::get('/daily', 'StatisticsController@getDailyStats');
        Route::get('/weekly', 'StatisticsController@getWeeklyStats');
        Route::get('/monthly', 'StatisticsController@getMonthlyStats');
    });
});