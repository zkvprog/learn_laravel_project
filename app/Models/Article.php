<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public $fillable = ['slug', 'title', 'preview', 'body', 'published'];
    //protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query, $val)
    {
        return $query->where('published', $val);
    }
}
