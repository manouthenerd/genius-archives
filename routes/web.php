<?php

use Inertia\Inertia;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\EnsureIsAuth;
use App\Http\Middleware\IsSuperAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifiedEmail;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsMemberOrAdmin;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\AccessKeysController;
use App\Http\Controllers\AdminsListController;
use App\Http\Controllers\MembersListController;
use App\Http\Middleware\TwoFactorVerified;

//Auth + email vérifié
Route::middleware([EnsureIsAuth::class, VerifiedEmail::class, TwoFactorVerified::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/parametres', [SettingsController::class, 'index']);
    Route::get('/parametres/edit', [SettingsController::class, 'index']);
    Route::put('/parametres/edit', [SettingsController::class, 'update']);
});

Route::middleware([EnsureIsAuth::class, VerifiedEmail::class])->group(function () {
    Route::get('2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
    // Route::put('2fa', [TwoFactorController::class, 'generate'])->name('2fa.generate');
    Route::post('2fa', [TwoFactorController::class, 'store'])->name('2fa.store');
});


//Superadmin ou Admin
Route::middleware([VerifiedEmail::class, EnsureIsAuth::class, IsAdmin::class, TwoFactorVerified::class])->group(function () {
    Route::get('corbeille', [TrashController::class, 'index']);
});

//Member ou Admin
Route::middleware([VerifiedEmail::class, EnsureIsAuth::class, IsMemberOrAdmin::class, TwoFactorVerified::class])->group(function () {

    Route::get('/mes-archives', function () {
        return Inertia::render('Archives', []);
    });

    Route::post('/archives/{id}/restore', [ArchiveController::class, 'restore']);


    Route::post('/archives/{id}', [ArchiveController::class, 'delete']);

    Route::delete('/archives/{id}', [ArchiveController::class, 'destroy']);

    Route::post('/folders', [FolderController::class, 'store']);

    Route::get('/folders/{id}', [FolderController::class, 'show']);
    Route::post('/folders/{id}/delete', [FolderController::class, 'delete']);
    Route::post('/folders/{id}', [FolderController::class, 'restore']);
    Route::delete('/folders/{id}', [FolderController::class, 'destroy']);


    Route::get('/nouvelle-archive', [ArchiveController::class, 'create']);

    Route::post('/temp', [ArchiveController::class, 'preview']);

    Route::post('/nouvelle-archive', [ArchiveController::class, 'store']);
});

// Superadmin
Route::middleware([EnsureIsAuth::class, VerifiedEmail::class, IsSuperAdmin::class, TwoFactorVerified::class])->group(function () {

    Route::get('/access-keys', [AccessKeysController::class, 'index'])->name('access-keys');
    Route::get('/access-keys/{id}', [AccessKeysController::class, 'edit'])->name('access-keys.edit');
    Route::put('/access-keys/{id}', [AccessKeysController::class, 'update']);
    Route::delete('/access-keys/{id}', [AccessKeysController::class, 'destroy']);
    Route::get('/nouvelle-clee', [AccessKeysController::class, 'create'])->name('access-keys.create');
    Route::post('/nouvelle-clee', [AccessKeysController::class, 'store'])->name('access-keys.create');
    Route::get('/admins', [AdminsListController::class, 'index'])->name('admins');
    Route::delete('/admins/{id}', [AdminsListController::class, 'destroy']);
    Route::get('/members', [MembersListController::class, 'index'])->name('members');
})->name('superadmin');

// Admin
Route::middleware([EnsureIsAuth::class, IsAdmin::class, VerifiedEmail::class, TwoFactorVerified::class])->group(function () {

    Route::get('/mes-membres', [MemberController::class, 'index'])->name('members');
    Route::get('/mes-membres/{id}/edit', [MemberController::class, 'show'])->name('show-member');
    Route::patch('/mes-membres/{id}/edit', [MemberController::class, 'update'])->name('edit-member');
    Route::post('/members/{id}/restore', [MemberController::class, 'restore']);
    Route::post('/members/{id}', [MemberController::class, 'delete']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    Route::get('/nouveau-membre', function () {
        return abort(404);
    });

    Route::post('/nouveau-membre', [MemberController::class, 'store']);

    Route::get('/historique', [HistoryController::class, 'index']);
});



require __DIR__ . '/auth.php';
