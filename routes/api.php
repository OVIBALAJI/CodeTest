<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\ApiController;
use App\http\Controllers\IntegrationController;



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

Route::post('/register',[ApiController::class,'register']);
Route::post('/login',[ApiController::class,'login']);
Route::get('/countries',[ApiController::class,'countries'])->middleware('auth:api');
Route::get('/states',[ApiController::class,'states'])->middleware('auth:api');
Route::get('/cities',[ApiController::class,'cities'])->middleware('auth:api');
Route::get('/getcountry',[IntegrationController::class,'getcountry']);
Route::get('/getstates',[IntegrationController::class,'getstates']);
Route::get('/getcity',[IntegrationController::class,'getcity']);