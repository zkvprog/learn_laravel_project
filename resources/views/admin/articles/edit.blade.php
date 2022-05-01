<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Edit article
                </div>

                <div class="p-6">
                    <form method="post" action="{{ route('admin.articles.update', ['article' => $article->id]) }}">
                        @csrf
                        @method('PATCH')

                        @include('articles.formfields')

                        <div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a class="btn btn-outline-primary" href="{{ url()->previous() }}">Вернуться</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
