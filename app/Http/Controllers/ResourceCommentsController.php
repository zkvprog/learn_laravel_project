<?php

namespace App\Http\Controllers;

use App\Models\AbstractContentResource;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class ResourceCommentsController extends Controller
{
    public function store(string $commentableType, AbstractContentResource $commentable)
    {
        $commentable->addComment(request()->validate([
            'text' => 'required|min:3|max:10000',
        ]));

        return back();
    }
}
