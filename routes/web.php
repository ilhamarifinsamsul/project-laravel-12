<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.layouts.app');
});

Route::get('/', [ProductController::class, 'frontend'])->name('home');
Route::get('/products', [ProductController::class, 'frontend'])->name('products.frontend');

Route::controller(LoginController::class)->prefix("auth")->name('auth.')->group(function(){
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/register', 'register')->name('register.submit');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/dashboard', function(){
    return view('admin.dashboard.index');
})->name('dashboard');

Route::resource('/category', CategoryController::class);

// route for resource products
Route::resource('/products', ProductController::class);

