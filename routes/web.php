<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\AdminController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify.post');

/*Backend Routes*/
Route::group(['prefix' => 'backend','middleware' => ['auth']], function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //Role Permission Routes
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);

    Route::get('/check', function () {
        $user = Auth::user();
        $user->assignRole('Admin');
        dd(Auth::user()->getRoleNames());
    });
});
