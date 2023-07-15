<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Models\Connection;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('/login',[AuthController::class,'loginUser'] );
Route::post('/register',[AuthController::class,'createUser'] );



   
Route::middleware('auth:sanctum')->group(function (){

       
   
   
        Route::controller(CustomerController::class)->group(function(){
        Route::get('/customer','index')->name('index');
        Route::post('/customer/store','store')->name('store');
        Route::get('/customer/{id}','show')->name('show');
        Route::put('/customer/{id}','update')->name('update');
        Route::delete('/customer/{id}','destroy')->name('destroy');
        
    });
     
    Route::put('/customer/extends-date/{id}', ConnectionController::class)->name('extend date');


    Route::controller(UserController::class)->group(function(){
        Route::get('/user','index')->name('index');
        Route::post('/user/store','store')->name('store')->withoutMiddleware('auth:sanctum');
        Route::get('/user/{id}','show')->name('show');
        Route::put('/user/{id}','update')->name('update');
        Route::delete('/user/{id}','destroy')->name('destroy');
        
    });
    


});

//responder rutas no autorizadas
Route::any('/error', function () {
    return response()->json(['message'=>'Proporcione un token de autorizacion'],401);
})->name('login');

//responder rutas endpoint inexistentes
Route::fallback(function () {
    return response()->json([
        'message' => 'El endpoint solicitado no existe'
    ], 404);});








    