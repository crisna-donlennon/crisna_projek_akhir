<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CartController;
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

Route::get('/', [HomeController::class, 'HomeView']);
Route::get('/home', [HomeController::class, 'HomeView'])->name('home');
Route::get('/redirect', function () {
    return view('redirectPage');
})->name('redirect');

Route::middleware(['guest'])->group(function() {
    // REGISTRATION
    Route::get('/adminregistration', [AuthenticationController::class, 'RegistrationView']);
    Route::post('/adminregistration', [AuthenticationController::class, 'register'])->name('register.store');
    // LOGIN
    Route::get('/login', [AuthenticationController::class, 'LoginView'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login.store');
});

// HOMEPAGE

// LOGOUT


// DASHBOARD
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);

    Route::middleware(['checkUserRole:admin'])->group(function () {
        // USER
        Route::get('/dashboard', [DashboardController::class, 'UserView'])->name('dashboard.user');
        Route::delete('/dashboard/user/{id}', [AuthenticationController::class, 'user.delete']);
        // TYPE 
        Route::get('/dashboard/type', [TypeController::class, 'TypeView'])->name('dashboard.type');
        Route::delete('/dashboard/type/{id}', [TypeController::class, 'delete'])->name('type.delete');
        Route::post('/dashboard/type', [TypeController::class, 'store'])->name('type.store');
        
        // PRODUCT 
        Route::get('/dashboard/product', [DashboardController::class, 'ProductView'])->name('dashboard.product');
        Route::get('/product/{id}', [ProductController::class, 'ProductView'])->name('product.index');
        Route::get('/dashboard/create-product', [ProductController::class, 'create'])->name('product.create');
        Route::post('/dashboard/create-product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/dashboard/product/{id}', [ProductController::class, 'product.delete'])->name('product.update'); 
    });    
    
});











Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/cart', [CartController::class, 'CartView'])->name('cart');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
