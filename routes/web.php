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
    return Inertia::render('Archives/CreateArchive', []);
});

Route::post('/nouvelle-archive', function (Request $request) {
    dd($request->all(), $request->file());
});

Route::get('/nouveau-membre', function (Request $request) {
    return Inertia::render('Member/CreateMember');
});

Route::get('/mes-membres', function (Request $request) {
    return Inertia::render('Member/Members');
});

Route::get('/historique', function (Request $request) {
    return Inertia::render('History');
});

Route::get('/parametres', function () {
    return Inertia::render('Settings', []);
});

Route::get('/parametres/edit', function () {
    return Inertia::render('Settings', []);
});

Route::get('/corbeille', function () {
    return Inertia::render('Trash', []);
});



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [SettingsController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [SettingsController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [SettingsController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
