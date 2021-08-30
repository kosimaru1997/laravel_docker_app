<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\SiteController;

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


Route::get('/memo', [MemoController::class, 'index'])->name('memo');
Route::post('/store', [MemoController::class, 'store'])->name('store');
Route::get('/memo/{id}/edit', [MemoController::class, 'edit'])->name('edit');
Route::post('/update', [MemoController::class, 'update'])->name('update');
Route::post('/destroy', [MemoController::class, 'destroy'])->name('destroy');
Route::post('/destroy_tag', [MemoController::class, 'destroy_tag'])->name('destroy_tag');

Route::get('/site/new', [SiteController::class, 'create'])->name('site_new');
Route::post('/site/store', [SiteController::class, 'store'])->name('site_store');
