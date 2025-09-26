<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('home');

Route::get("/login", [AuthController::class, 'showLogin'])->name('showLogin');
Route::post("/login", [AuthController::class, 'login'])->name('login');
