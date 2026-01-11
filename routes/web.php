<?php

use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

