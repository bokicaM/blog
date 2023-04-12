<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/create/post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/create/post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/{post:slug}/edit', [PostController::class, 'update'])->name('posts.update');
    Route::delete('{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('categories/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create/category', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/create/category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category:slug}/edit', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/api', [WebServiceController::class,'callWebService'])->name('api');

});
//Route::resource('/categories', CategoryController::class);

