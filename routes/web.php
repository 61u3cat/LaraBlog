<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;



Route::get('/', [RegisterController::class, 'register'])->name('register.view');
Route::post('/register', [RegisterController::class, 'regsave'])->name('register.save');

Route::get('login', [RegisterController::class, 'login'])->name('login');
Route::post('login', [RegisterController::class, 'loginsave'])->name('login.save');
Route::get('forgot_password', [RegisterController::class, 'forgotPassword'])->name('forgot.password');
Route::get('recover_password', [RegisterController::class, 'recoverPassword'])->name('recover.password');
Route::get('/editor', [EditorController::class, 'editor'])->name('editor');
Route::post('/editor', [EditorController::class, 'postsave'])->name('editor.view');
Route::get('/category', [EditorController::class, 'category'])->name('category.view');
Route::post('/category', [EditorController::class, 'categorysave'])->name('category.save');
Route::get('/category/{id}', [EditorController::class, 'categorysave'])->name('category.edit');




// url('tuhin') main url + browser work url https://localhost/tuhin
// route('asdf') just name for code // https://localhost/tuhin


Route::middleware('auth')->group(function () {
    Route::get('/lists', [RegisterController::class, 'dataview'])->name('lists');
    Route::get('/user/{id}/edit', [RegisterController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [RegisterController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [RegisterController::class, 'delete'])->name('user.delete');
    Route::post('/logout',[RegisterController::class,'logout'])->name('logout');
});
