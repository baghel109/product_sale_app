<?php

use App\Http\Controllers\auth\AuthController;
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
    return view('welcome');
});













Route::group(['middleware'=> ['isAuthenticated']], function(){
        Route::get('/register', [AuthController::class, 'register'])->name('register.view');
        Route::post('/register-save', [AuthController::class, 'registerSave'])->name('register.save');
        Route::get('/user/verify/{token}', [AuthController::class, 'verify'])->name('verify');


        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'loginSave'])->name('login.save');

        Route::get('/forgot-password', [AuthController::class, 'forgotPasswordView'])->name('forgotPasswordView');
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');

        Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('resetPassword');
        Route::post('/reset-password/{token}', [AuthController::class, 'resetPasswordUpdate'])->name('resetPasswordUpdate');

});

Route::group(['middleware'=> ['onlyAuthenticated']], function(){

    
        Route::get('/front/dashboard', function(){
            return 'front dashboard';
        })->name('front.dashboard');

});

Route::group(['middleware'=> ['onlyAuthenticated','onlyAdmin']], function(){

        Route::get('/admin/dashboard', function(){
            return 'test admin dashboard';
        })->name('admin.dashboard');

});

