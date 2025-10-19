<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.auth.login');
})->name('login');
Route::get('/registration', function () {
    return view('user.auth.registration');
})->name('register');
