<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
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

//ruta login
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'createUser']);


Route::middleware('auth:sanctum')->group(function () {

    //clientes
    Route::apiResource('customer', CustomerController::class);

    //actulizar fecha vencimineto de la conexion
    Route::put('/customer/extends-date/{customerID}', ConnectionController::class)->name('extend date')->can('update','customerID');
 
    //datos usuarios
    Route::resource('user', UserController::class)->only(['show', 'update']);

    //acciones para usuario que solo hacen admins
    Route::resource('user', UserController::class)->only(['index', 'destroy']);
});



//responder rutas no autorizadas en caso que no tenga el accept "application/json"
Route::get('/error', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');

//responder rutas endpoint inexistentes en caso que no tenga el accept "application/json"
Route::fallback(function () {
    return response()->json([
        'message' => 'El endpoint solicitado no existe'
    ], 404);
});
