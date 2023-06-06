@component('mail::message')
    Activity on the site

    # New articles on the site: {{ $articlesCount }}
    # New comments under the articles: {{ $articlesCommentCount }}
    # New news on the site: {{ $newsCount }}
    # New comments under the news: {{ $newsCommentCount }}

    Thanks, {{ config('app.name') }}
@endcomponent
