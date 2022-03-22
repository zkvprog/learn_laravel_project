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

            <div class="form-group">
                <label for="exampleInputTitle">ЧПУ</label>
                <input type="text" class="form-control" id="exampleInputSlug" required placeholder="Введите ЧПУ"
                       name="slug"
                       value="{{ old('slug', $article->slug) }}"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputTitle">Название статьи</label>
                <input type="text"  class="form-control" id="exampleInputTitle" required placeholder="Введите название"
                       name="title"
                       value="{{ old('title', $article->title) }}"
                >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Краткое описание статьи</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" required rows="3"
                          name="preview"
                >{{ old('preview', $article->preview) }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea2">Детальное описание</label>
                <textarea name="body"
                          class="form-control" id="exampleFormControlTextarea2" required rows="3"
                >{{ old('body', $article->body) }}</textarea>
            </div>
            <div class="form-group form-check">
                <input name="published" type="checkbox" class="form-check-input" id="exampleCheck1" value="1" @if(old('publiched', $article->published)) checked @endif>
                <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-outline-primary" href="/articles/{{ $article->slug }}">Вернуться к просмотру статьи</a>
            </div>
        </form>

    </div>
@endsection
