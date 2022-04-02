<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleCommentsController extends Controller
{
    public function store(Article $article)
    {
        $article->addComment(request()->validate([
            'text' => 'required|min:3|max:10000',
        ]));

        return back();
    }
}
