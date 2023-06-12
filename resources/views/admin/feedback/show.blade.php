<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <fieldset disabled>
                    <div class="form-group">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" id="InputEmail" value="{{ $feedback->email }}">
                    </div>
                    <div class="form-group">
                        <label for="TextareaMessage">Message</label>
                        <textarea class="form-control" id="TextareaMessage" rows="5">{{ $feedback->text }}</textarea>
                    </div>
                </fieldset>

                <div class="mt-2">
                    <a class="btn btn-outline-primary" href="{{ url()->previous() }}">Вернуться</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
