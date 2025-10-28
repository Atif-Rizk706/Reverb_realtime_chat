<?php

use App\Http\Controllers\Webcontrollers\Authentication\AuthController;
use App\Http\Controllers\webcontrollers\Chat\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webcontrollers\Chat\HomeController;

Route::get('/', function () {
    return view('user.auth.login');
})->name('login');


Route::post('/login', [AuthController::class,'login'])->name('post_login');


Route::get('/registration', function () {
    return view('user.auth.registration');
})->name('register');



Route::post('/registration',[AuthController::class,'registration'] )->name('post_register');


Route::middleware('auth')->group(function (){
    Route::get('/home', [HomeController::class,'users'])->name('home');
    Route::get('/privet_chat/{user}', [HomeController::class,'userChat'])->name('privet_chat');
    Route::post('/privet_chat/{user}/send', [ChatController::class,'sendMessage'])->name('send_message');
    Route::post('/privet_chat/typing', [ChatController::class,'typing'])->name('typing');
    Route::post('/online', [ChatController::class,'setOnline'])->name('online');
    Route::post('/offline', [ChatController::class,'setOffline'])->name('offline');

});
