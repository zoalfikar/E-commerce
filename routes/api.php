<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\payment\MyFatoorahController;
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

Route::middleware('auth:sanctum')->group(function ()
{
    Route::post('/products/{id?}', [ApiController::class,'products']);
    Route::get('/add-product', [ApiController::class,'addInfoProduct']);
    Route::post('/add-product', [ApiController::class,'addProduct']);
});

///
Route::post('regist', [ApiAuthController::class,'regist']);
Route::post('login', [ApiAuthController::class,'login']);
Route::post('logout', [ApiAuthController::class,'logout']);
///




Route::get('/l', function (){
    return [
        "hello"=> "i starte using api"
    ];

});

Route::post('/payWith-MyFatoora',[MyFatoorahController::class,'payOrder'] );

