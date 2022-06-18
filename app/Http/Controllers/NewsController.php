<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequests;
use App\Models\News;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequests $request, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();
        $news = News::create($attributes);

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $news);

        return redirect('/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $newsEditUrl = auth()->user()->isAdmin() ? route('admin.news.edit', ['news' => $news->id]) : route('news.edit', ['news' => $news->slug]);
        $news->load(['comments' => function($query) {
            $query->with('user')->get();
        }]);

        return view('news.show', ['news' => news, 'newsEditUrl' => $newsEditUrl]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequests $request, News $news, TagsSynchronizer $tagsSynchronizer)
    {
        $news->update($request->validated());

        $tagsSynchronizer->sync(collect(explode(',', request('tags'))), $news);

        return redirect('/news/' . $news->slug);
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
        return redirect('/news');
    }
}
