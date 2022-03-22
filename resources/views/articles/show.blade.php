@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">


        <div class="blog-post">
            <h2 class="blog-post-title">{{$article->title}}</h2>
            <form method="post" action="/articles/{{ $article->slug }}">
                @csrf
                @method('DELETE')

                <p class="blog-post-meta d-flex align-items-center">
                    <span class="mr-2">{{$article->created_at->toFormattedDateString()}}</span>
                    <a class="mr-2 btn btn-sm btn-primary" href="/articles/{{ $article->slug }}/edit">Изменить статью</a>
                    <button type="submit" class="mr-2 btn btn-sm btn-danger">Удалить статью</button>
                </p>
            </form>

            <p>{{$article->preview}}</p>
            <hr>
            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->


        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="/articles">Вернуться к списку статей</a>
        </nav>

    </div><!-- /.blog-main -->
@endsection
