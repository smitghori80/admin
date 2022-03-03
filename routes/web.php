<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard')->middleware('authentication');
// ->middleware('permission:Dashboard');

Route::get('register', [AuthenticationController::class, 'registerForm'])->name('registerForm');
Route::post('register', [AuthenticationController::class, 'registerFormSubmit'])->name('registerFormSubmit');
Route::get('login', [AuthenticationController::class, 'loginForm'])->name('loginForm');
Route::post('login', [AuthenticationController::class, 'loginFormSubmit'])->name('loginFormSubmit');
Route::get('forgotpassword/email', [AuthenticationController::class, 'forgotPasswordForm'])->name('forgotPasswordForm');
Route::post('forgotpassword/email', [AuthenticationController::class, 'forgotPasswordFormSubmit'])->name('forgotPasswordFormSubmit');
Route::get('verify/{token}', [AuthenticationController::class, 'verify'])->name('verify');
Route::get('password/reset/{token}', [AuthenticationController::class, 'ResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthenticationController::class, 'ResetPasswordFormSubmit'])->name('ResetPasswordFormSubmit');


Route::group(['prefix' => '/', 'middleware' => ['authentication']], function () {
    Route::get('logout', [AuthenticationController::class, 'Logout'])->name('logout');
    Route::get('profile', [AuthenticationController::class, 'profileFrom'])->name('profileForm');
    Route::post('profile', [AuthenticationController::class, 'profileFormSubmit'])->name('profileFormSubmit');
    Route::get('change_password', [AuthenticationController::class, 'ChangePasswordForm'])->name('ChangePasswordForm');
    Route::post('change_password', [AuthenticationController::class, 'ChangePasswordFormSubmit'])->name('ChangePasswordFormSubmit');
});

Route::group(['prefix' => '/user', 'as' => 'user.', 'middleware' => ['authentication']], function () {
    Route::get('/', [UserController::class, 'index'])->name('list');
    Route::get('create', [UserController::class, 'create'])->name('create'); #->middleware('permission:user-create')
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::post('update', [UserController::class, 'update'])->name('update');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::delete('destroy', [UserController::class, 'destroy'])->name('destroy');
    Route::get('state', [UserController::class, 'state'])->name('state');
    Route::get('role', [UserController::class, 'role'])->name('role');
});

Route::group(['prefix' => '/role', 'as' => 'role.', 'middleware' => ['authentication']], function () {
    Route::get('/', [RoleController::class, 'index'])->name('list');
    Route::get('create', [RoleController::class, 'create'])->name('create');
    Route::post('store', [RoleController::class, 'store'])->name('store');
    Route::post('{id}/update', [RoleController::class, 'update'])->name('update');
    Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::delete('destroy', [RoleController::class, 'destroy'])->name('destroy');
    Route::get('permission', [RoleController::class, 'permission'])->name('permission');
});

Route::group(['prefix' => '/settings', 'as' => 'settings.', 'middleware' => ['authentication']], function () {
    Route::get('store_data', [SettingsController::class, 'storeData'])->name('storeData');
    Route::post('store_data', [SettingsController::class, 'storeDataType'])->name('storeDataType');
});
