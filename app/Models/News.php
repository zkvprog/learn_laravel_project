<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends AbstractContentResource
{
    use HasFactory;

    public $fillable = ['slug', 'title', 'preview', 'body', 'published', 'owner_id'];

    public static function getContentType()
    {
        return 'news';
    }
}
