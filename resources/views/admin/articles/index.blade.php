<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Title</th>
                            <th scope="col">User</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$article->slug}}</td>
                                <td>{{$article->title}}</td>
                                <td>{{$article->owner->name}}</td>
                                <td>
                                    <a class="edit-icon-link" href="{{ route('admin.articles.edit', ['article' => $article->id]) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    @if($article->published)
                                        <i class="js-unpublish-card icon-link fas fa-eye-slash" data-url="{{ route('admin.articles.update.published', ['article' => $article->id]) }}"></i>
                                    @else
                                        <i class="js-publish-card icon-link fas fa-eye" data-url="{{ route('admin.articles.update.published', ['article' => $article->id]) }}"></i>
                                    @endif
                                </td>
                                <td>
                                    <i class="icon-link js-delete-card fas fa-trash-alt" data-url="{{ route('admin.articles.delete', ['article' => $article->id]) }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
