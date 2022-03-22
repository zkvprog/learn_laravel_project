<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ArticlesController;

Route::get('/', [\App\Http\Controllers\ArticlesController::class, 'index']);
Route::view('/about/', 'about');
Route::view('/contacts/', 'contacts');

Route::resource('articles', ArticlesController::class);

Route::post('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'store']);
Route::get('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'index']);
