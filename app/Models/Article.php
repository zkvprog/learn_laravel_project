<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;
use App\Events\ArticleDeleted;
use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasHistory;
    public $fillable = ['slug', 'title', 'preview', 'body', 'published', 'owner_id'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query, $val)
    {
        return $query->where('published', $val);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment(array $attributes)
    {
        return $this->comments()->create(['user_id' => auth()->id()] + $attributes);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
