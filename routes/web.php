<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;
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

Route::middleware(['guest'])->group(function () {
    // REGISTRATION
    Route::get('/registration', [AuthenticationController::class, 'RegistrationView']);
    Route::post('/registration', [AuthenticationController::class, 'register'])->name('register.store');
    Route::get('/adminregistration', [AuthenticationController::class, 'AdminRegistrationView']);
    Route::post('/adminregistration', [AuthenticationController::class, 'adminregister'])->name('adminregister.store');
    // LOGIN
    Route::get('/login', [AuthenticationController::class, 'LoginView'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login.store');
});

// DASHBOARD
Route::middleware(['auth'])->group(function () {
    Route::patch('/dashboard/user/{id}/update-role', [AuthenticationController::class, 'updaterole'])->name('user.update');
    Route::middleware(['checkUserRole:admin,pemilik'])->group(function () {
        // USER
        Route::get('/dashboard', [DashboardController::class, 'UserView'])->name('dashboard.user');
        // Route::delete('/dashboard/user/delete', [AuthenticationController::class, 'delete'])->name('user.delete');
        // Route::delete('/dashboard/user/{id}', [AuthenticationController::class, 'delete'])->name('user.delete');
        Route::delete('/dashboard/user/{id}', [AuthenticationController::class, 'delete'])->name('user.delete');
        // Route::post('/dashboard/user/{id}/update-role', [AuthenticationController::class, 'update.role'])->name('user.update');


        // TYPE 
        Route::get('/dashboard/type', [TypeController::class, 'TypeView'])->name('dashboard.type');
        Route::delete('/dashboard/type/{id}', [TypeController::class, 'delete'])->name('type.delete');
        Route::post('/dashboard/type', [TypeController::class, 'store'])->name('type.store');

        // PRODUCT 
        Route::get('/dashboard/product', [DashboardController::class, 'ProductView'])->name('dashboard.product');
        Route::get('/dashboard/create-product', [ProductController::class, 'create'])->name('product.create');
        Route::post('/dashboard/create-product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/dashboard/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
        // Route::get('/productmain/search', [ProductController::class, 'search'])->name('product.search');
        // Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
        // Route::get('/products/search-ajax', [ProductController::class, 'searchAjax'])->name('search.result');
        // Route::get('/search', [ProductController::class, 'search'])->name('product.search');

        // INVOICE
        Route::get('/dashboard/invoice', [DashboardController::class, 'InvoiceView'])->name('dashboard.invoice');

        Route::get('/create-alamat', [AlamatController::class, 'create'])->name('alamat.create');
        Route::post('/store-alamat', [AlamatController::class, 'store'])->name('alamat.store');
        Route::get('/get-province', [AlamatController::class, 'get_province'])->name('alamat.get_province');
        Route::get('/get-city/{id}', [AlamatController::class, 'get_city'])->name('alamat.get_city');
    });
    
    
    Route::get('/product/{id}', [ProductController::class, 'ProductView'])->name('product.index');
    Route::get('/logout', [AuthenticationController::class, 'logout']);
   
    Route::get('/productmain', [ProductController::class, 'ProductMain'])->name('product.main');
    
    Route::get('/cart', [CartController::class, 'CartView'])->name('cart');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

    Route::post('/order/pay-and-create', [OrderController::class, 'payAndCreateOrder'])->name('order.payAndCreateOrder');
    Route::post('/order/destroy', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::put('/order/terima', [OrderController::class, 'terima'])->name('order.terima');
    Route::put('/order/selesai', [OrderController::class, 'selesai'])->name('order.selesai');
    Route::get('/order/pesanan-pending', [OrderController::class, 'PesananPendingView'])->name('order.PesananPendingView');
    Route::get('/order/pesanan-paid', [OrderController::class, 'PesananPaidView'])->name('order.PesananPaidView');

    Route::get('/account', [AuthenticationController::class, 'index'])->name('account.index');
    Route::patch('/account', [AuthenticationController::class, 'update'])->name('account.update');
});
