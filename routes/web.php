<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ArticlesController::class, 'index']);
Route::view('/about/', 'about');
Route::view('/contacts/', 'contacts');

Route::get('articles/tags/{tag}', [\App\Http\Controllers\TagsController::class, 'index']);
//Комментарии
Route::post('/articles/{article}/comments', [\App\Http\Controllers\ArticleCommentsController::class, 'store']);
//Статьи
Route::resource('articles', \App\Http\Controllers\ArticlesController::class);

Route::post('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'store'])->middleware(['auth']);
Route::get('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
