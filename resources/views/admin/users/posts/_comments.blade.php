
{{-- isset($comments()) && $comments->count() > 0 --}}
@if (true)
    @foreach ($comments as $comment)
        <div class="media mt-4 col-md-12 text-center">

            {{-- comment author --}}
            <a class="pr-3" href="#">
                <img class="rounded-circle" alt=" {{ $comment->author->name }}" width="30" height="30"
                    src="{{ $comment->author->avatar }}" />
            </a>

            <div class="media-body">

                <div class="row">
                    <div class="col-12 d-flex">
                        <h5>{{ $comment->author->name }}</h5>
                        <span>{{$comment->getTimeAgo($comment->created_at)}}</span>
                    </div>
                </div>

                {{ $comment->body }}

            </div>
        </div>
    @endforeach

    {{ $comments->links() }}
@endif
