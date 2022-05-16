<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PushMessageRequest;
use App\Services\PushAll\PushAllSelf;
use function back;
use function view;

class PushServiceController extends Controller
{
    public function index()
    {
        return view('admin.pushall.index');
    }

    public function send(PushMessageRequest $request, PushAllSelf $pushAll)
    {
        $attributes = $request->validated();
        $pushAll->send($attributes['title'], $attributes['text']);

        return back()->with('info', 'Сообщение отправлено');
    }
}
