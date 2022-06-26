@if($contentResource->comments->isNotEmpty())
    <ul class="list-group">
        @foreach($contentResource->comments as $comment)
            <div class="list-group-item">
                <div>
                    <small class="text-muted">{{$article->created_at->toFormattedDateString()}}</small>
                </div>
                <div class="h5">
                    {{ $comment->user->name }}
                </div>
                <div>
                    {{$comment->text}}
                </div>
            </div>
        @endforeach
    </ul>
@endif

