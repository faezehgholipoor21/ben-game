<?php

use App\Http\Controllers\site\products\siteProductController;
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
Route::namespace('App\Http\Controllers\api')
    ->name('api.')
    ->group(function () {
        //general
//        Route::post('get-car-models-with-brand', [generalApiController::class, 'get_car_models_with_brand'])->name('get_car_models_with_brand');
        Route::post('/addToCart', [siteProductController::class, 'addToCart'])->name('addToCart');
        Route::post('/updateCart', [siteProductController::class, 'updateCart'])->name('updateCart');
//        Route::post('/removeFromCart', [generalApiController::class, 'removeFromCart'])->name('removeFromCart');
    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
