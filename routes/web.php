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

// Route::get('/', function () {
//     return view('layouts.frontend.register');
// });

Route::get('/register', [AuthController::class, 'register'])->name('register.view');
Route::post('/register-save', [AuthController::class, 'registerSave'])->name('register.save');
Route::get('/user/verify/{verification_token}', [AuthController::class, 'verify'])->name('verify');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSave'])->name('login.save');

Route::get('/front/dashboard', function(){
    return 'front dashboard';
})->name('front.dashboard');

Route::get('/admin/dashboard', function(){
    return 'admin dashboard';
})->name('admin.dashboard');


