<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequests;
use App\Models\News;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        $contentResourcesType = News::getContentType();
        View::share('contentResourcesType', $contentResourcesType);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = News::all();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequests $request, News $news)
    {
        $news->update($request->validated());

        return redirect()->route('admin.news.show' , $news->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return response()->json(['status' => 'ok']);
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePublished(News $news)
    {
        $news->update(['published' => \request()->input('published')]);

        return response()->json(['status' => 'ok']);
    }
}
