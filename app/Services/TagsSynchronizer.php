<?php

namespace App\Services;

use App\Models\Tag;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TagsSynchronizer
{
    public function sync(Collection $tags, Model $model) {
        //Ключи мапы по name
        $modelTags = $model->tags->keyBy('name');
        $tags = $tags->keyBy(function($item) {
            return $item;
        });

        //Которые уже есть в модели и в реквесте
        $syncIds = $modelTags->intersectByKeys($tags)->pluck('id')->toArray();
        //Которые добавились в реквесте
        $tagsToAttach = $tags->diffKeys($modelTags);
        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $model->tags()->sync($syncIds);
    }
}
