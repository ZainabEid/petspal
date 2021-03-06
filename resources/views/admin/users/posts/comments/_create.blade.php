 {{-- create comment --}}
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


        {{-- body --}}
        <div class="media-body">

            {!! Form::text('body', null) !!}

        </div>

        {!! Form::submit(__('Add'), ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
</div>