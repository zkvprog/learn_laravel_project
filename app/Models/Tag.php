<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'tag_article');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public static function tagsCloud()
    {
        $tagsQuery = (new static)->has('articles')->withCount('articles')->orderBy('articles_count', 'desc');

        return Cache::remember('tags:cloud', 60 * 60 * 4, function () use ($tagsQuery) {
            return $tagsQuery->paginate(5);
        });

    }
}
