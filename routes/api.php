<?php

use App\Http\Controllers\loginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [loginController::class ,'createUser']);
Route::post('/login', [loginController::class ,'loginUser']);

Route::middleware('admin')->group(function () {
            Route::get('/admin', [loginController::class ,'info']);
});
Route::middleware('user')->group(function () {
Route::get('user', function() {
    return Auth::user()->rol;
});

});
