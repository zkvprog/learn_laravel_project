<?php

namespace App\Http\Controllers;

use App\Events\ArticleCreated;
use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->middleware('can:update,article')->except(['index', 'create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                $articles = Article::with('tags')->latest()->get();
            } else {
                $articles = auth()->user()->articles()->published(1)->with('tags')->latest()->get();
            }


        } else {
            $articles = Article::published(1)->with('tags')->latest()->get();
        }

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();
        $article = Article::create($attributes);

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $article);

        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $articleEditUrl = auth()->user()->isAdmin() ? route('admin.articles.edit', ['article' => $article->id]) : route('article.edit', ['article' => $article->slug]);
        $article->load(['comments' => function($query) {
            $query->with('user')->get();
        }]);

        return view('articles.show', ['article' => $article, 'articleEditUrl' => $articleEditUrl]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article, TagsSynchronizer $tagsSynchronizer)
    {
        $article->update($request->validated());

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $article);

        return redirect('/articles/' . $article->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/articles');
    }
}
