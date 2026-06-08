<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
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
            return getAppData('facebook'). ' front dashboard';
        })->name('front.dashboard');

});

Route::group(['prefix'=> 'admin/', 'as'=> 'admin.', 'middleware'=> ['onlyAuthenticated','onlyAdmin']], function(){

        // Route::get('dashboard', function(){
        //     return 'test admin dashboard';
        // })->name('admin.dashboard');

        Route::get('dashboard', [AppController::class, 'index'])->name('dashboard');
        Route::post('save', [AppController::class, 'save'])->name('save');

        // menus
        Route::get('/menus', [MainController::class, 'index'])->name('menus');
        Route::post('/add-menu', [MainController::class, 'addMenu'])->name('addMenu');
        Route::get('/delete-menu/{id}', [MainController::class, 'deleteMenu'])->name('deleteMenu');
        Route::get('/edit-menu/{id}', [MainController::class, 'editMenu'])->name('editMenu');
        Route::put('/update-menu', [MainController::class, 'updateMenu'])->name('updateMenu');

        // categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        Route::post('/add/category', [CategoryController::class, 'addCategory'])->name('addCategory');
        Route::put('/edit/category', [CategoryController::class, 'editCategory'])->name('editCategory');
        Route::put('/update/category', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::get('/delete/category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');




        



        




        


        


});

