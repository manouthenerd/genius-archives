<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', []);
});

Route::post('/', function (Request $request) {
    dd($request);
});

Route::get('/mes-archives', function () {
    return Inertia::render('Archives', []);
});

Route::get('/nouvelle-archive', function () {
    return Inertia::render('Archives', []);
});

Route::get('/parametres', function () {
    return Inertia::render('Settings', []);
});
Route::get('/parametres/edit', function () {
    return Inertia::render('Settings', []);
});



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
