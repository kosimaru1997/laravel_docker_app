<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ApiController;

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

Route::get('/sites', [SiteController::class, 'index'])->name('sites');
Route::get('/site/new', [SiteController::class, 'create'])->name('site_new');
Route::post('/site/store', [SiteController::class, 'store'])->name('site_store');
Route::get('/site/{id}', [SiteController::class, 'show'])->name('site_show');
Route::get('/site/{id}/edit', [SiteController::class, 'edit'])->name('site_edit');
Route::post('/site/{id}/update', [SiteController::class, 'update'])->name('site_update');
Route::post('/site/{id}/destroy', [SiteController::class, 'destroy'])->name('site_destroy');

Route::get('/api/preview', [ApiController::class, 'preview'])->name('preview');
