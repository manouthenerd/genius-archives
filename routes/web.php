<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', []);
});

Route::get('/mes-archives', function () {
    return Inertia::render('Archives', []);
});

Route::get('/nouvelle-archive', function () {
    return Inertia::render('CreateArchive', []);
});

Route::post('/nouvelle-archive', function (Request $request) {
    dd($request->all(), $request->file());
});

Route::get('/parametres', function () {
    return Inertia::render('Settings', []);
});
Route::get('/parametres/edit', function () {
    return Inertia::render('Settings', []);
});



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [SettingsController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [SettingsController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [SettingsController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
