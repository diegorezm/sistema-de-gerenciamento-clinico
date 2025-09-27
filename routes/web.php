<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Organization\OrganizationController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('home');

Route::get("/login", [AuthController::class, 'showLogin'])->name('showLogin');
Route::get("/register", [AuthController::class, 'showRegister'])->name('showRegister');
Route::post("/login", [AuthController::class, 'login'])->name('login');
Route::post("/register", [AuthController::class, 'register'])->name('register');
Route::post("/logout", [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::prefix('organizations')->name('organizations.')->group(function () {
        Route::get('/', [OrganizationController::class, 'index'])->name('index');
        Route::post('/', [OrganizationController::class, 'store'])->name('store');
        Route::get('/{organization}', [OrganizationController::class, 'show'])->name('show');
        Route::put('/{organization}', [OrganizationController::class, 'update'])->name('update');
        Route::delete('/{organization}', [OrganizationController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name("index");
    });
});
