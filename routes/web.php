<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ShowRegistrationFormController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ShowLoginFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\PurchaseController;

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

Route::get('/', [ProductController::class, 'index'])->name('home');

// Auth Routes (Registration, Login, Logout)
Route::get('/register', ShowRegistrationFormController::class)->name('register')->middleware('guest');
Route::post('/register', RegisterController::class)->middleware('guest');
Route::get('/login', ShowLoginFormController::class)->name('login')->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest');

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

// Auth Profile Routes
Route::middleware(['auth'])
    ->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [UserProfileController::class, 'show'])->name('show');
    Route::get('/edit', [UserProfileController::class, 'edit'])->name('edit');
    Route::put('/', [UserProfileController::class, 'update'])->name('update');
    Route::get('/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('change-password.form');
    Route::post('/change-password', [UserProfileController::class, 'changePassword'])->name('change-password');
});

// Ordinary User Routes
Route::middleware(['auth', 'isOrdinary'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');

    Route::post('/purchase', PurchaseController::class)->name('purchase');
});

// Admin Routes
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::patch('/users/{user}/promote', [AdminUserController::class, 'promote'])->name('users.promote');
    Route::resource('products', AdminProductController::class);
});
