<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'index'])
    ->name('contacts.index');

Route::get('/contacts', [ContactController::class, 'create']);

Route::post('/contacts/confirm', [ContactController::class, 'confirm'])
    ->name('contacts.confirm');

Route::post('/contacts', [ContactController::class, 'store'])
    ->name('contacts.store');

Route::get('/thanks', [ContactController::class, 'thanks'])
     ->name('thanks');  

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
