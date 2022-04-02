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


        <nav class="blog-pagination mb-5">
            <a class="btn btn-outline-primary" href="/articles">Вернуться к списку статей</a>
        </nav>

        <div>
            <div class="mb-2">
                @include('layout.errors')

                <form method="post" action="/articles/{{ $article->slug }}/comments">
                    @csrf

                    <div class="form-group mb-1">

                        <label for="exampleFormControlTextarea1" class="h5">Написать комментарий</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" required rows="3"
                                  name="text"
                        ></textarea>
                    </div>
                    <div class="d-flex align-items-end flex-column">
                        <button class="btn btn-primary" type="submit">Отправить</button>
                    </div>
                </form>
            </div>

            @if($article->comments->isNotEmpty())
                <ul class="list-group">
                    @foreach($article->comments as $comment)
                        <div class="list-group-item">
                            <div>
                                <small class="text-muted">{{$article->created_at->toFormattedDateString()}}</small>
                            </div>

                            <div>
                                {{$comment->text}}
                            </div>
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>

    </div><!-- /.blog-main -->
@endsection
