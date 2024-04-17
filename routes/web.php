<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
})->name('/');

Auth::routes();
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify.post');

/*Backend Routes*/
Route::group(['prefix' => 'backend','middleware' => ['auth']], function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile-page', [ProfileController::class, 'profilePage'])->name('profile.page');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/password-update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    //Role Permission Routes
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
});
