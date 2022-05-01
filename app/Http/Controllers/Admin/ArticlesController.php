<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $articles = Article::all();

        return view('admin.articles.index', compact('articles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
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

        return redirect('/admin/articles/' . $article->id);
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

        return response()->json(['status' => 'ok']);
    }

    public function updatePublished(Article $article)
    {
        $article->update(['published' => \request()->input('published')]);

        return response()->json(['status' => 'ok']);
    }
}
