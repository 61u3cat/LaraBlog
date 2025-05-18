<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('LaraBlog.index');
Route::get('/post/{slug}', [HomeController::class, 'showBlog'])->name('blog-details');
Route::get('/category/{slug}', [HomeController::class, 'categoryPosts'])->name('category.posts');
Route::get('/about', [HomeController::class, 'about'])->name('LaraBlog.about');
Route::get('/home', [HomeController::class, 'homeIndex'])->name('LaraBlog.indexhome');
Route::get('/contact', [HomeController::class, 'contact'])->name('LaraBlog.contact');
Route::get('/writeblog', [HomeController::class, 'BlogWrite'])->name('administrator.LaraBlog.write');
Route::get('/search', [HomeController::class, 'search'])->name('blog.search');





Route::get('/register', [RegisterController::class, 'register'])->name('register.view');
Route::post('/register', [RegisterController::class, 'regsave'])->name('register.save');

Route::get('login', [RegisterController::class, 'login'])->name('login');
Route::post('login', [RegisterController::class, 'loginsave'])->name('login.save');


Route::get('forgot_password', [RegisterController::class, 'forgotPassword'])->name('forgot.password');
Route::post('forgot_password', [RegisterController::class, 'forgotPasswordToken'])->name('forgot.token');


Route::get('reset-password/{email}/{token}', [RegisterController::class, 'recoverPassword'])->name('reset-password');
Route::post('reset-password/{email}/{token}', [RegisterController::class, 'recoverPasswordSave'])->name('reset-password.save');




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
    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
});
