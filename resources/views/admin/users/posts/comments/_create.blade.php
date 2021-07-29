<div class="card-body">
    <div class="media mt-4 col-md-12 text-center">
        {!! Form::open(['route' => ['admin.posts.comments.store', $post->id], 'role' => 'form']) !!}
       
        {{-- comment author --}}

        {{-- choose comment auther from users --}}
        <div class="align-self-stretch p-2 m-1">

            {!! Form::label('user_id', __('Comment Writer:'), ['class' => 'boldfont']) !!}

            <select name="user_id" class="form-select" aria-label="select example">
                <option selected value="{{ null }}">
                    <label for="user_id" class="boldfont">{{ __('Choose User') }}</label>
                </option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- on change change the comment header --}}

        {{-- author --}}
        <div>

            {{-- <a class="pr-3" href="#">
                <img class="rounded-circle" alt=" {{ $comment->author->name }}" width="30" height="30"
                    src="{{ $comment->author->avatar }}" />
            </a> --}}
            {{-- <div class="row">
                            <div class="col-12 d-flex">
                                <h5>{{ $comment->author->name }}</h5>
                                <span>{{ $comment->time ?? '- 3 hours ago' }}</span>
                            </div>
                        </div> --}}
        </div>

        {{-- body --}}
        <div class="media-body">

            {!! Form::text('body', null) !!}

        </div>
    </div>
</div>
