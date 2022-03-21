<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::published(1)->latest()->get(); // scopePublished ::where('published', $val)

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function store()
    {
        $this->validate(request(), [
            'slug' => 'required|unique:articles|min:3|max:100|alpha_dash',
            'title' => 'required|min:5|max:100',
            'preview' => 'required|max:255',
            'body' => 'required',
        ]);

        Article::create([
            'slug' => request('slug'),
            'title' => request('title'),
            'preview' => request('preview'),
            'body' => request('body'),
            'published' => (int) request('published'),
        ]);

        /*$article = new Article();
        $article->slug = request('slug');
        $article->title = request('title');
        $article->preview = request('preview');
        $article->body = request('body');
        $article->published = (int) request('published');

        $article->save();*/

        return redirect('/articles');
    }
}
