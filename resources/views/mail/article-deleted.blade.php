@component('mail::message')
    # Удалена статья {{ $article->title }}

    {{ $article->preview }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
