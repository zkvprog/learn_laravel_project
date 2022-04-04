@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="/articles">
            @csrf

            @include('articles.formfields')
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

    </div>
@endsection
