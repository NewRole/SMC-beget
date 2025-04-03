<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApiController;

Route::get('/ratings', [ApiController::class, 'getRatings'])->name('ratings');
Route::get('/', function () {
    return view('index');
});
Route::get('/rules', function () {
    return view('rules');
})->name('rules');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Профиль пользователя
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.profile');
    })->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

// Регистрации пользователя

Route::post('/registrations', [RegistrationController::class, 'store'])
    ->middleware('auth');
Route::middleware('auth')->group(function() {
    Route::get('/my-registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
});
Route::middleware('auth')->group(function() {
    Route::get('/my-registrations', [RegistrationController::class, 'index'])
        ->name('registrations.index');
});
Route::middleware('auth')->group(function() {
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])
        ->name('registrations.destroy');
});
// Игры
Route::get('/games', [GameController::class, 'index'])->name('games.index');


// Админка
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;

Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->group(function() {
    Route::get('/games', [AdminController::class, 'games'])->name('admin.games');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/games', [AdminController::class, 'games'])->name('admin.games');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('admin.users.updateStatus');
});

