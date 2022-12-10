<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
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
                        @foreach($news as $newsCard)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$newsCard->slug}}</td>
                                <td>{{$newsCard->title}}</td>
                                <td>{{$newsCard->owner->name}}</td>
                                <td>
                                    <a class="edit-icon-link" href="{{ route('admin.news.edit', ['news' => $newsCard->id]) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    @if($newsCard->published)
                                        <i class="js-unpublish-article icon-link fas fa-eye-slash" data-url="{{ route('admin.news.update.published', ['news' => $newsCard->id]) }}"></i>
                                    @else
                                        <i class="js-publish-article icon-link fas fa-eye" data-url="{{ route('admin.news.update.published', ['news' => $newsCard->id]) }}"></i>
                                    @endif
                                </td>
                                <td>
                                    <i class="icon-link js-delete-article fas fa-trash-alt" data-url="{{ route('admin.news.delete', ['news' => $newsCard->id]) }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $news->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
