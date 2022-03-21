@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">{{$article->title}}</h2>
            <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}} by <a href="#">Mark</a></p>

            <p>{{$article->preview}}</p>
            <hr>
            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->


        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="/articles">Вернуться к списку статей</a>
        </nav>

    </div><!-- /.blog-main -->
@endsection
