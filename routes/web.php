<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetsController;

Route::get('/', function () {

    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');

});

// Login route
Route::get('/login', [ LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');


    Route::resource('timesheets', TimesheetsController::class);
    Route::post('/timesheets', [TimesheetsController::class, 'store'])->name('timesheets.store');

    Route::get('/calendar', function () {
        return view('dashboard.pages.calendar');
    })->name('calendar');

    Route::get('/invoices', function () {
        return view('dashboard.pages.generateinvoice');
    })->name('invoices');

    Route::post('/invoices', [InvoicesController::class, 'store'])->name('invoices.store');

    Route::get('/kanban', function () {
        return view('dashboard.pages.kanban');
    })->name('kanban');

});
