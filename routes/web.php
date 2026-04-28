<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('users', 'users')->name('users.index');
    Route::view('pekerjaan', 'pekerjaan')->name('pekerjaan.index');
    Route::view('inventaris', 'inventaris')->name('inventaris.index');
});

require __DIR__.'/settings.php';
