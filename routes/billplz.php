<?php

use App\Http\Controllers\Billplz\BillplzController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Billplz Routes
|--------------------------------------------------------------------------
|
| Here is where you can register billplz routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('test', [BillplzController::class, 'statusPayment']);
Route::get('/billplz', [BillplzController::class, 'callback'])->name('billplz.callback');