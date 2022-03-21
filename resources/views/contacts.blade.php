@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Контакты
        </h3>

        @include('layout.errors')

        <form method="post" action="/admin/feedback">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input required name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Сообщение</label>
                <textarea name="text" class="form-control" id="exampleFormControlTextarea1" required rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

    </div>
@endsection
