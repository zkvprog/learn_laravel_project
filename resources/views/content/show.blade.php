@extends('layout.without_sidebar')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{$contentResource->title}}</h2>
            <form method="post" action="{{ route($contentResourcesType . '.destroy', $contentResource->slug) }}">
                @csrf
                @method('DELETE')

                <p class="blog-post-meta d-flex align-items-center">
                    <span class="mr-2">{{ $contentResource->created_at->toFormattedDateString()}}</span>
                    @can('update', $contentResource)
                        <a class="mr-2 btn btn-sm btn-primary" href="{{ $contentResourceEditUrl }}">Изменить статью</a>
                        <button type="submit" class="mr-2 btn btn-sm btn-danger">Удалить статью</button>
                    @endcan
                </p>
            </form>

            <p>{{ $contentResource->preview }}</p>

            <hr>

            <p>{{ $contentResource->body }}</p>
        </div>

        <nav class="blog-pagination mb-5">
            <a class="btn btn-outline-primary" href="{{ route($contentResourcesType . '.index') }}">Вернуться к списку</a>
        </nav>

        @include('comments.index', ['contentResourceType' => $contentResource->getMorphClass(), 'contentResource' => $contentResource])
    </div>
@endsection
