<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;
use App\Events\ArticleDeleted;
use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends AbstractContentResource
{
    use HasFactory;

    public $fillable = ['slug', 'title', 'preview', 'body', 'published', 'owner_id'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class,
    ];

    public static function getContentType()
    {
        return 'articles';
    }
}
