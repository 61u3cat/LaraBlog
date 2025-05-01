<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/lists',[RegisterController::class,'dataview'])->name('lists');

Route::get('/register',[RegisterController::class,'register'])->name('register.view');
Route::post('/register',[RegisterController::class,'regsave'])->name('register.save');

Route::get('login', [RegisterController::class, 'login'])->name('login.view');
Route::post('login', [RegisterController::class, 'loginsave'])->name('login.save');

Route::get('/user/{id}/edit',[RegisterController::class,'edit'])->name('user.edit');
Route::put('/user/{id}', [RegisterController::class, 'update'])->name('user.update');

Route::delete('/user/{id}',[RegisterController::class,'delete'])->name('user.delete');


