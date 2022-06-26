<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequests;
use App\Models\News;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index');

        $contentResourcesType = News::getContentType();
        View::share('contentResourcesType', $contentResourcesType);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                $contentResources = News::latest()->simplePaginate(8);
            } else {
                $contentResources = auth()->user()->news()->published(1)->latest()->simplePaginate(10);
            }
        } else {
            $contentResources = News::published(1)->latest()->simplePaginate(10);
        }

        return view('content.index', compact('contentResources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequests $request)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();
        $news = News::create($attributes);

        return redirect()->route('news.index');
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

        return view('content.show', ['contentResource' => $news, 'contentResourceEditUrl' => $newsEditUrl]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('content.edit', compact('news'));
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

        return redirect()->route('news.edit', $news->slug);
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
        return redirect()->route('news.index');
    }
}
