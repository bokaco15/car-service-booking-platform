<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SerachServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::name('service.')->prefix('/service')->group(function() {
    Route::view('/search', 'service.search')->name('search.blade');
    Route::post('/search', [SerachServiceController::class, 'search'])->name('search');
});
