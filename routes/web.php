<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', [TestController::class, 'test']);

Route::get('contact-us', [TestController::class, 'contactUs']);
Route::get('about-us', [TestController::class, 'aboutUs']);
Route::get('home', [TestController::class, 'home']);

Route::get('books/create', [BookController::class, 'create'])->name('books.create');
Route::post('books/store', [BookController::class, 'store'])->name('books.store');
Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::post('books/{book}/update', [BookController::class, 'update'])->name('books.update');
Route::post('books/{book}/destroy', [BookController::class, 'destroy'])->name('books.destroy');
