<?php

use Illuminate\Support\Facades\Route;

//Страницы на главной
Route::get('/', [\App\Http\Controllers\ArticlesController::class, 'index'])->name('home');
Route::view('/about/', 'about');
Route::view('/contacts/', 'contacts');

Route::get('/test', function () {
   event(new \App\Events\TestEvent);
});

//Теги
Route::get('articles/tags/{tag}', [\App\Http\Controllers\TagsController::class, 'index']);

//Комментарии
Route::post('/{commentableType}/{commentable}/comments', [\App\Http\Controllers\ResourceCommentsController::class, 'store'])->name('comments.store');

//Статьи
Route::resource('articles', \App\Http\Controllers\ArticlesController::class, [
    'names' => [
        'create' => 'articles.create',
        'show' => 'articles.show',
        'edit' => 'articles.edit'
    ]
]);

//Новости
Route::resource('news', \App\Http\Controllers\NewsController::class, [
    'names' => [
        'create' => 'news.create',
        'show' => 'news.show',
        'edit' => 'news.edit'
    ]
]);

//Админ раздел
Route::middleware(['auth'])->group(function() {
    Route::middleware(['admin'])->group(function() {
        Route::prefix('admin')->group(function() {
            Route::post('/feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'store']);
            Route::get('/feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('admin.feedback');
            Route::get('/feedback/{feedback:id}', [\App\Http\Controllers\Admin\FeedbackController::class, 'show'])->name('admin.feedback.show');

            Route::get('/sendpush', [\App\Http\Controllers\Admin\PushServiceController::class, 'index'])->name('admin.pushall.form');
            Route::post('/sendpush', [\App\Http\Controllers\Admin\PushServiceController::class, 'send'])->name('admin.pushall.send');

            Route::get('/articles', [\App\Http\Controllers\Admin\ArticlesController::class, 'index'])->name('admin.articles');
            Route::get('/articles/{article:id}', [\App\Http\Controllers\Admin\ArticlesController::class, 'edit'])->name('admin.articles.edit');
            Route::patch('/articles/{article:id}', [\App\Http\Controllers\Admin\ArticlesController::class, 'update'])->name('admin.articles.update');
            Route::delete('/articles/{article:id}', [\App\Http\Controllers\Admin\ArticlesController::class, 'destroy'])->name('admin.articles.delete');
            Route::put('/articles/{article:id}/published', [\App\Http\Controllers\Admin\ArticlesController::class, 'updatePublished'])->name('admin.articles.update.published');

            Route::get('/news', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('admin.news');
            Route::get('/news/{news:id}', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('admin.news.edit');
            Route::patch('/news/{news:id}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('admin.news.update');
            Route::delete('/news/{news:id}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('admin.news.delete');
            Route::put('/news/{news:id}/published', [\App\Http\Controllers\Admin\NewsController::class, 'updatePublished'])->name('admin.news.update.published');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
