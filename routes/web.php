<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorpayPaymentController;

use App\Models\Products;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Models\Admin;

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
    $categories = Category::all();
    $products = Products::all(); // Fetch all products
    return view('landing', compact('categories', 'products'));
})->name('landing');
// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/about', 'about')->name('about');
Route::view('/terms', 'terms')->name('terms');


// Dashboard (for logged in users only)
    Route::get('/dashboard', function () {
        return view('welcome');
    })->middleware('auth')->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    // add other protected routes here
});



Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// Admin Dashboard

// Admin Login Form
Route::get('/admin', function () {
    return view('admin.login');
})->name('admin.login');

// Admin Login Submit
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.submit');




Route::prefix('admin')->middleware('auth:admin')->group(function() {
    Route::get('/dashboard', function () {
        $totalProducts = Products::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalProducts',  'totalCategories','totalOrders', 'totalUsers'));
    })->name('admin.dashboard');



    Route::post('logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});

Route::prefix('admin')->middleware('auth:admin')->group(function(){
         Route::resource('categories', CategoryController::class);
});

// Route::get('admin/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
// Route::get('admin/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');

Route::get('admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/my-orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
// });

Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{id}/invoice', [App\Http\Controllers\OrderController::class, 'downloadInvoice'])->name('orders.invoice');
});

Route::get('/contact',[ContactController::class,'showForm'])->name('contact.form');
Route::post('/contact',[ContactController::class,'sendMessage'])->name('contact.send');


// In routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/razorpay/payment', [RazorpayPaymentController::class, 'payment'])->name('razorpay.payment');
    Route::post('/razorpay/success', [RazorpayPaymentController::class, 'success'])->name('razorpay.success');

});



Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/orders/export/excel', [App\Http\Controllers\Admin\OrderController::class, 'exportExcel'])->name('admin.orders.exportExcel');
});


// Show form
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');

// Handle email + send OTP
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.email');

// Show OTP verify form
Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('password.otp');

// Handle OTP verification
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.otp.verify');

// Show password reset form
Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('password.reset');

// Handle password update
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
