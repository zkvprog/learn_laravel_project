@component('mail::message')
    # Изменена статья {{ $article->title }}

    {{ $article->preview }}

    @component('mail::button', ['url' => 'articles/' . $article->slug])
        Прочитать
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
