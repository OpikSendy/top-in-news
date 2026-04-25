<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return redirect('/top-news');
});

// 🔥 MAIN ROUTES
Route::get('/top-news', [NewsController::class, 'index'])->name('top-news');
Route::get('/all-news', [NewsController::class, 'allNews'])->name('all-news');
Route::get('/category/{name}', [NewsController::class, 'category'])->name('category');
Route::get('/detail-news/{id}', [NewsController::class, 'detail'])->name('detail-news');

// 🔥 BONUS ROUTES (dari controller full)
Route::get('/live', [NewsController::class, 'live'])->name('live');
Route::get('/trending', [NewsController::class, 'trending'])->name('trending');

Route::get('/admin/news', [NewsController::class, 'adminIndex'])->name('admin.news.index');
Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
Route::post('/admin/news/store', [NewsController::class, 'store'])->name('admin.news.store');
Route::get('/admin/news/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
Route::post('/admin/news/update/{id}', [NewsController::class, 'update'])->name('admin.news.update');
Route::post('/admin/news/delete/{id}', [NewsController::class, 'delete'])->name('admin.news.delete');
Route::post('/admin/news/toggle/{id}', [NewsController::class, 'toggle'])->name('admin.news.toggle');
Route::post('/admin/news/update-status/{id}', [NewsController::class, 'updateStatus'])->name('admin.news.updateStatus');
Route::post('/comment/{id}', [NewsController::class, 'comment'])->name('comment.store');
