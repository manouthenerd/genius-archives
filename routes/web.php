<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\EnsureIsAuth;
use App\Http\Middleware\IsSuperAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifiedEmail;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsMemberOrAdmin;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\IsSuperAdminOrAdmin;
use App\Http\Controllers\AccessKeysController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\FolderController;

//Auth + email vérifié
Route::middleware([EnsureIsAuth::class, VerifiedEmail::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/parametres', [SettingsController::class, 'index']);

});

//Superadmin ou Admin
Route::middleware([VerifiedEmail::class, EnsureIsAuth::class, IsSuperAdminOrAdmin::class])->group(function () {
    Route::get('corbeille', [TrashController::class, 'index']);
});

//Member ou Admin
Route::middleware([VerifiedEmail::class, EnsureIsAuth::class, IsMemberOrAdmin::class])->group(function () {
    Route::get('/mes-archives', function () {
        return Inertia::render('Archives', []);
    });

    Route::post('/folders', [FolderController::class, 'store']);

    Route::get('/nouvelle-archive', [ArchiveController::class, 'create']);
    
    Route::post('/nouvelle-archive', [ArchiveController::class, 'store']);
});

// Superadmin
Route::middleware([EnsureIsAuth::class, VerifiedEmail::class, IsSuperAdmin::class])->group(function () {

    Route::get('/mes-cles', [AccessKeysController::class, 'index'])->name('access-keys');
    Route::get('/nouvelle-clee', [AccessKeysController::class, 'create'])->name('access-keys.create');
    Route::post('/nouvelle-clee', [AccessKeysController::class, 'store'])->name('access-keys.create');

})->name('superadmin');

// Admin
Route::middleware([EnsureIsAuth::class, IsAdmin::class, VerifiedEmail::class])->group(function () {

    Route::get('/mes-membres', [MemberController::class, 'index'])->name('members');
    Route::get('/mes-membres/{id}/edit', [MemberController::class, 'show'])->name('show-member');
    Route::patch('/mes-membres/{id}/edit', [MemberController::class, 'update'])->name('edit-member');
    Route::delete('/mes-membres/{id}', [MemberController::class, 'destroy']);

    Route::get('/nouveau-membre', function() {
        return abort(404);
    });

    Route::post('/nouveau-membre', [MemberController::class, 'store']);
    
    Route::get('/historique', function (Request $request) {
        return Inertia::render('History');
    });
});



require __DIR__.'/auth.php';