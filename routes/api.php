<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('index', [UserApiController::class, 'index']);
Route::post('create', [UserApiController::class, 'create']);
Route::post('allusers', [UserApiController::class, 'allusers']);
Route::delete('delete', [UserApiController::class, 'delete']);
Route::get('edit', [UserApiController::class, 'edit']);
Route::post('update', [UserApiController::class, 'update']);
Route::get('role', [UserApiController::class, 'role']);
Route::get('state', [UserApiController::class, 'state']);
