<?php

use App\Http\Controllers\AccessKeyGeneratorController;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccessKeysController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TrashController;

Route::middleware('auth')->group(function() {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

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
    
    Route::get('/parametres', [SettingsController::class, 'index'])->name('settings');
    Route::get('/parametres/edit', [SettingsController::class, 'index']);
    
    Route::get('/corbeille', [TrashController::class, 'index']);

});

Route::middleware('auth')->group(function () {

    Route::get('/mes-cles', [AccessKeysController::class, 'index'])->name('access-keys');
    Route::get('/nouvelle-clee', [AccessKeysController::class, 'create'])->name('access-keys.create');
    Route::post('/nouvelle-clee', [AccessKeysController::class, 'store'])->name('access-keys.create');
    Route::get('/access-key-generator', AccessKeyGeneratorController::class);

})->name('superadmin');

require __DIR__.'/auth.php';