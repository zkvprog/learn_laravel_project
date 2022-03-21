@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="/articles">
            @csrf

            <div class="form-group">
                <label for="exampleInputTitle">ЧПУ</label>
                <input type="text" name="slug" class="form-control" id="exampleInputSlug" required placeholder="Введите ЧПУ">
            </div>
            <div class="form-group">
                <label for="exampleInputTitle">Название статьи</label>
                <input type="text" name="title" class="form-control" id="exampleInputTitle" required placeholder="Введите название">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Краткое описание статьи</label>
                <textarea name="preview" class="form-control" id="exampleFormControlTextarea1" required rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea2">Детальное описание</label>
                <textarea name="body" class="form-control" id="exampleFormControlTextarea2" required rows="3"></textarea>
            </div>
            <div class="form-group form-check">
                <input name="published" type="checkbox" class="form-check-input" id="exampleCheck1" value="1">
                <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

    </div>
@endsection
