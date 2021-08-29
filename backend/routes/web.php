<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;

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
    logger('welcome route.');
    return view('welcome');
});

Auth::routes();

// Route::get('/tag', [MemoController::class, 'index'])->name('index');
Route::get('/memo', [MemoController::class, 'index'])->name('memo');
Route::post('/store', [MemoController::class, 'store'])->name('store');
Route::get('/memo/{id}/edit', [MemoController::class, 'edit'])->name('edit');
Route::post('/update', [MemoController::class, 'update'])->name('update');
Route::post('/destroy', [MemoController::class, 'destroy'])->name('destroy');
