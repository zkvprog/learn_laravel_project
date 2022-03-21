<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ArticlesController::class, 'index']);

Route::get('/about/', function () {
    return view('about');
});

Route::get('/contacts/', function () {
    return view('contacts');
});

Route::get('/articles', [\App\Http\Controllers\ArticlesController::class, 'index']);
Route::post('/articles', [\App\Http\Controllers\ArticlesController::class, 'store']);
Route::get('/articles/create', function () {
    return view('articles.create');
});
Route::get('/articles/{article}', [\App\Http\Controllers\ArticlesController::class, 'show']);

Route::post('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'store']);
Route::get('/admin/feedback', [\App\Http\Controllers\FeedbackController::class, 'index']);
