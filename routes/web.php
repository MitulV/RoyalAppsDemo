<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// UserController.php
Route::get('/profile', [UserController::class,'showProfile'])->middleware('auth')->name('profile');
Route::get('/login', [UserController::class,'index'])->name('login');
Route::post('/login', [UserController::class,'login']);
Route::get('/logout', [UserController::class,'logout'])->middleware('auth')->name('logout');


Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth')->name('dashboard');

Route::get('/authors/{id}/delete', [AuthorController::class,'delete'])->name('deleteAuthor');
Route::get('/authors/{id}', [AuthorController::class,'show'])->name('viewAuthor')->middleware('auth');


Route::get('/books/{id}/{authorId}/delete', [BookController::class,'delete'])->name('deleteBook')->middleware('auth');

Route::get('/add-book', [BookController::class, 'showAddForm'])->name('showAddBookForm')->middleware('auth');
Route::post('/add-book', [BookController::class, 'addBook'])->name('addBook')->middleware('auth');
