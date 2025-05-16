<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryControler;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware(IsAdminMiddleware::class)->group(function () {
        Route::resource('categories', CategoryControler::class);
        Route::resource('posts', PostController::class);
    });


});


require __DIR__ . '/auth.php';
