<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\itemsController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\authController;
use App\Http\Controllers\binController;
use App\Http\Controllers\ordersController;


Route::get('/', [itemsController::class, 'items'])->name('home');

Route::get('/cat/{id}', [itemsController::class, 'items']);

Route::get('/item/{id}', [itemsController::class, 'about'])->name('item');

Route::middleware(['guest'])->group(function(){
    Route::post('/register', [registerController::class, 'register'])->name('register');
    Route::post('/auth', [authController::class, 'auth'])->name('login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [registerController::class, 'profile'])->name('profile');
    Route::get('/logout', [authController::class, 'logout'])->name('logout');
    Route::post('/item/{id}/newComm', [itemsController::class, 'newComm'])->name('newComm');
    Route::post('/addOrder', [binController::class, 'addOrder'])->name('addOrder');
    Route::get('/bin', [binController::class, 'card'])->name('card');
    Route::post('/countItem', [binController::class, 'countItem'])->name('countItem');
    Route::get('/deleteCardItem/{id}', [binController::class, 'deleteItem'])->name('deleteItem');
    Route::get('/ordering', [ordersController::class, 'ordersView'])->name('ordersView');
    Route::post('/ordering/newOrder', [ordersController::class, 'newOrder'])->name('newOrder');
});
