<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Отправить уведомление
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('layout.errors')

                <form method="post" action="{{ route('admin.pushall.send') }}">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInpuotTitle">Заголовок</label>
                        <input required name="title" type="text" class="form-control" id="exampleInpuotTitle" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Сообщение</label>
                        <textarea required name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
