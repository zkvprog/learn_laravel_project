<?php

namespace App\Models;

use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractContentResource extends Model
{
    use HasHistory;

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
