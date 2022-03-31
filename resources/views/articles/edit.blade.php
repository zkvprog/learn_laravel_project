@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Изменение статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="/articles/{{ $article->slug }}">
            @csrf
            @method('PATCH')

            @include('articles.formfields')

            <div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-outline-primary" href="/articles/{{ $article->slug }}">Вернуться к просмотру статьи</a>
            </div>
        </form>

    </div>
@endsection
