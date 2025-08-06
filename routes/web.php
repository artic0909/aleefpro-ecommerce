<?php

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::get('/search', [CustomerController::class, 'searchProducts'])->name('search.products');

Route::get('/download-catelogue', [CustomerController::class, 'downloadCatelogue'])->name('catelogue.download');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// require __DIR__.'/auth.php';
// require __DIR__.'/customer-routes.php';
// require __DIR__.'/admin-routes.php';
