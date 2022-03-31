@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="row mb-2">
            @foreach($articles as $article)
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h3 class="mb-0">
                                <a class="text-dark" href="/articles/{{$article->slug}}">{{$article->title}}</a>
                            </h3>
                            <div class="mb-1 text-muted">{{$article->created_at->toFormattedDateString()}}</div>
                            <p class="card-text mb-auto">{{$article->preview}}</p>
                            <a href="/articles/{{$article->slug}}" class="small">Continue reading</a>
                        </div>
                        <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/120x150?theme=thumb" alt="Thumbnail [200x250]" style="width: 120px; height: 150px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17f8e993650%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17f8e993650%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.1953125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                    </div>
                </div>
            @endforeach
        </div>

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div>
@endsection
