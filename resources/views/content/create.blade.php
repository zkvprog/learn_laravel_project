@extends('layout.without_sidebar')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{trans('content.creating.' . $contentResourcesType)}}
        </h3>

        @include('layout.errors')

        <form method="post" action="{{ route('news.store') }}">
            @csrf

            @include('content.formfields')
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

    </div>
@endsection
