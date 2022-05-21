<?php

namespace App\Models\Traits;

use App\Models\History;
use App\Models\User;

trait HasHistory
{
    protected $entity;
    protected static $tableHistory = 'history';

    protected static function getHistoryEvents()
    {
        return ['created', 'updated', 'deleted'];
    }

    public static function bootHasHistory()
    {
        foreach (static::getHistoryEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->addChangesInHistory($model, $event);
            });
        }
    }

    protected function addChangesInHistory($model, $event)
    {
        $this->history()->create([
            'user_id' => auth()->id(),
            'action' => $event,
            'changes' => json_encode($model->getDirty())
        ]);
    }

    public function history()
    {
        return $this->morphMany(History::class, 'historable', 'model', 'model_id');
    }
}
