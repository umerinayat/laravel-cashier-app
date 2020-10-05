<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscribeController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/subscribe', [SubscribeController::class, 'index']);
Route::post('/subscribe', [SubscribeController::class, 'subscribe']);



Route::get('{slug}', [HomeController::class, 'showPost']);


