@extends('layout.without_sidebar')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ trans('content.changing.' . $contentResourcesType) }}
        </h3>

        @include('layout.errors')

        <form method="post" action="{{ route($contentResourceType . '.edit', $contentResource->slug) }}">
            @csrf
            @method('PATCH')

            @include('content.formfields')

            <div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-outline-primary"
                   href="{{ route($contentResourceType . '.show', $contentResource->slug) }}">Вернуться к просмотру</a>
            </div>
        </form>

    </div>
@endsection
