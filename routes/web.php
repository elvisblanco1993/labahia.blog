<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ArticleController::class, 'public'])->name('home');
Route::get('/{article}', [ArticleController::class, 'view'])->name('articles.view');

Route::get('/tag/{tag}', [TagController::class, 'filter'])->name('tags.filter');
Route::get('/author/{user}', [UserController::class, 'filter'])->name('author.filter');

Route::get('/tips/submit', [TipController::class, 'create'])->name('tips.create');
Route::post('/tips/submit', [TipController::class, 'store'])->name('tips.store');


Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', function() { return view('dashboard'); })->name('dashboard');

    Route::get('/articles', App\Http\Livewire\Articles\Index::class)->name('articles');
    Route::get('/articles/create', App\Http\Livewire\Articles\Create::class)->name('articles.create');
    Route::get('/articles/{article}/edit', App\Http\Livewire\Articles\Edit::class)->name('articles.edit');
    Route::get('/articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::get('/articles/{article}/delete', [ArticleController::class, 'delete'])->name('articles.delete');

    Route::get('/users', App\Http\Livewire\Users\Index::class)->name('users');
});
