<?php

use Illuminate\Support\Facades\Route;

//Страницы на главной
Route::get('/', [\App\Http\Controllers\ArticlesController::class, 'index'])->name('home');
Route::view('/about/', 'about');
Route::view('/contacts/', 'contacts');

//Теги
Route::get('articles/tags/{tag}', [\App\Http\Controllers\TagsController::class, 'index']);

//Комментарии
Route::post('/articles/{article}/comments', [\App\Http\Controllers\ArticleCommentsController::class, 'store']);

//Статьи
Route::resource('articles', \App\Http\Controllers\ArticlesController::class, [
    'names' => [
        'edit' => 'articles.edit'
    ]
]);

//Админ раздел
Route::middleware(['auth'])->group(function() {
    Route::middleware(['admin'])->group(function() {
        Route::prefix('admin')->group(function() {
            Route::post('/feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'store']);
            Route::get('/feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('admin.feedback');

            Route::get('/articles', [\App\Http\Controllers\Admin\ArticlesController::class, 'index'])->name('admin.articles');
            Route::get('/articles/{article:id}', [\App\Http\Controllers\Admin\ArticlesController::class, 'edit'])->name('admin.articles.edit');
            Route::patch('/articles/{article:id}', [\App\Http\Controllers\Admin\ArticlesController::class, 'update'])->name('admin.articles.update');
            Route::delete('/articles/{article:id}', [\App\Http\Controllers\Admin\ArticlesController::class, 'destroy'])->name('admin.articles.delete');
            Route::put('/articles/{article:id}/published', [\App\Http\Controllers\Admin\ArticlesController::class, 'updatePublished'])->name('admin.articles.update.published');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
