<h3>Последние новости</h3>
<table>
    @foreach($articles as $article)
        <tr>
            <td>{{ route('articles.show', ['article' => $article->slug]) }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->preview }}</td>
        </tr>
    @endforeach
</table>
