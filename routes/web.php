<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ShowRegistrationFormController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ShowLoginFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserProfileController;

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
    return view('welcome'); // Placeholder, will be replaced by ProductController@index
})->name('home');

// Registration Routes
Route::get('/register', ShowRegistrationFormController::class)->name('register')->middleware('guest');
Route::post('/register', RegisterController::class)->middleware('guest');

// Login Routes
Route::get('/login', ShowLoginFormController::class)->name('login')->middleware('guest');
Route::post('/login', LoginController::class)->middleware('guest');

// Logout Route
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

// Placeholder routes for links in app.blade.php - to be implemented later
Route::get('/cart', function() { return 'Cart Page'; })->name('cart.index')->middleware('auth'); // Placeholder
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show')->middleware('auth');

// Routes for editing profile
Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Routes for changing password
Route::get('/profile/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('profile.change-password.form')->middleware('auth');
Route::post('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('profile.change-password')->middleware('auth');
