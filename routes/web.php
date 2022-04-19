<?php

use App\Http\Controllers\HomeController;
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
//TODO change route id to slug
Route::get('/', [HomeController::class, 'index'])->name('utama');
Route::get('/galeri/{id}', [HomeController::class, 'galleries'])->name('gallery');
Route::get('/video/{id}', [HomeController::class, 'videos'])->name('video');
Route::get('/buku/{cat_id}', [HomeController::class, 'book'])->name('book');
Route::get('/penyaluran', [HomeController::class, 'penyaluran'])->name('penyaluran');
