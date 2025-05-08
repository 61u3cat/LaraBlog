<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('index');
//Route::get('/{slug}', [HomeController::class, 'home'])->name('blog-details');


Route::get('/register', [RegisterController::class, 'register'])->name('register.view');
Route::post('/register', [RegisterController::class, 'regsave'])->name('register.save');

Route::get('login', [RegisterController::class, 'login'])->name('login');
Route::post('login', [RegisterController::class, 'loginsave'])->name('login.save');
Route::get('forgot_password', [RegisterController::class, 'forgotPassword'])->name('forgot.password');
Route::get('recover_password', [RegisterController::class, 'recoverPassword'])->name('recover.password');



// url('tuhin') main url + browser work url https://localhost/tuhin
// route('asdf') just name for code // https://localhost/tuhin


Route::middleware('auth')->group(function () {
    Route::get('/lists', [RegisterController::class, 'dataview'])->name('lists');
    Route::get('/user/{id}/edit', [dashboardController::class, 'edit'])->name('user.edit');
    Route::post('/user/{id}', [dashboardController::class, 'update'])->name('user.edit.save');
    Route::delete('/user/{id}', [dashboardController::class, 'delete'])->name('user.delete');
    Route::get('/editor', [EditorController::class, 'editor'])->name('editor');
    Route::post('/editor', [EditorController::class, 'postsave'])->name('editor.view');
    Route::get('/category', [EditorController::class, 'category'])->name('category.view');
    Route::post('/category', [EditorController::class, 'categorysave'])->name('category.save');
    Route::get('/category/{id}', [EditorController::class, 'categorysave'])->name('category.edit');
    Route::get('/posts', [dashboardController::class, 'postview'])->name('posts');

    Route::get('/posts/{id}/edit', [dashboardController::class, 'postedit'])->name('editpost');
    Route::post('/posts/{id}/edit', [EditorController::class, 'PostUpdateSave'])->name('editor.update');
    Route::post('/posts/{id}', [dashboardController::class, 'delete'])->name('post.delete');
    Route::post('/logout', [dashboardController::class, 'logout'])->name('logout');
});
