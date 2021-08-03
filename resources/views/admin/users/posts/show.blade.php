@extends('admin.layouts.app')

@push('styles')

    <style>
        .filled-heart {
            fill: #be0000;
            stroke-width: 0;
        }

    </style>

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> --}}

    {{-- bootstrap links for sliders --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

@endpush

@section('content')
    <main class="content">
        <div class="row card d-flex justify-content-center align-items-center" style="width: 80%">
            <div class="col-md-12">

                {{-- post header --}}
                <div class="mt-2 d-flex flex-row justify-content-between align-items-center ">

                    {{-- author --}}
                    <div>
                        <img style="float: left;" src="{{ url($post->author->avatar) }}" width="30" height="30" class="rounded-circle me-2"
                            alt="{{ $post->author->name }}">

                        <h5 style="float: left;">{{ $post->author->name }}</h5>

                    </div>

                    {{-- 3dots menue --}}
                    <div class="3dots-menue">

                        <div class="float-end text-navy">
                            <li class="dropdown" style=" list-style-type: none;">


                                <a class=" d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                    <i class="align-middle" data-feather="more-horizontal"></i>
                                </a>


                                <div class="dropdown-menu dropdown-menu-end">

                                    {{-- edit post --}}
                                    <a class="dropdown-item"
                                        href="{{ route('admin.users.posts.edit', [$post->author->id, $post->id]) }}">
                                        {{ __('Edit Post') }}
                                    </a>

                                    <form id="post-delete-form"
                                        action="{{ route('admin.users.posts.destroy', [$post->author->id, $post->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        {{-- delete post --}}
                                        <button type="submit" class="dropdown-item"
                                            onclick="document.getElementById('post-delete-form').submit()"
                                            href="{{ route('admin.users.posts.destroy', [$post->author->id, $post->id]) }}">
                                            {{ __('Delete Post') }}
                                        </button>
                                    </form>



                                </div>
                            </li>
                        </div>
                    </div>

                </div>

                {{-- post content --}}
                <div class="row">


                    {{-- post images --}}
                    <div id="postImage" class="carousel slide" data-ride="carousel" data-interval="false">

                        {{-- slides indecators --}}
                        <ol class="carousel-indicators " style=" list-style-type: none;">
                            @foreach ($post->collection() as $index => $image)

                                <li data-target="#postImage" data-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}"></li>

                            @endforeach

                        </ol>


                        {{-- slider images --}}
                        <div class="carousel-inner">

                            @foreach ($post->collection() as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                                    <img class="d-block" width="200" height="200" style="width:100,height:100"
                                        src="{{ url($image->getUrl()) }}">

                                    {{-- if video show thumbnail and the play icon over it --}}
                                    {{-- <iframe src="{{ url($media->file_name) }}" frameborder="0"></iframe> --}}
                                </div>
                            @endforeach


                        </div>


                        {{-- prev --}}
                        <a class="carousel-control-prev" href="#postImage" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('Previous') }}</span>
                        </a>

                        {{-- next --}}
                        <a class="carousel-control-next" href="#postImage" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{ __('Next') }}</span>
                        </a>
                    </div>



                    {{-- post body --}}
                    <p>

                        {!!  $post->body !!}


                    </p>

                </div>

                {{-- post footer --}}
                <div class="row  d-flex justify-content-between">

                    {{-- like & comment --}}
                    <div class="">

                        {{-- {{ $user->hasLiked($post)  ? 'true' : 'false' }} --}}



                        {{-- like count --}}
                        <span class="likes-icon" data-post="{{ $post->id }}"
                            data-url="{{ route('admin.posts.like', [$post->id, $users->first()->id]) }}">
                            <i id="heart-{{ $post->id }}" class="align-middle" data-feather="heart"></i>
                            <small>{{ $post->likes ? $post->likes->count() : 0 }}</small>
                            {{-- <a href="{{ route('admin.posts.like',[$users->first()->id , $post->id]) }}">like</a>
                                <a href="{{ route('admin.posts.unlike',[$users->first()->id , $post->id]) }}">unlike</a> --}}
                        </span>

                        {{-- comments count --}}
                        <span class="comments-icon" style="cursor: pointer;"
                            data-url="{{ route('admin.posts.comments.index', $post->id) }}"
                            data-post="{{ $post->id }}">

                            <i class="align-middle" data-feather="message-square"></i>
                            <small>{{ $post->comments ? $post->comments->count() : 0 }}</small>
                        </span>



                    </div>

                    {{-- time --}}
                    <div class="">

                        <span>
                            <small class="float-end text-navy">{{ $post->getTimeAgo($post->created_at) }}</small>
                        </span>

                    </div>

                </div>


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

                {{-- comments --}}
                <div class="row ml-5 " id="comments-area-{{ $post->id }}">

                    <h5>{{ __('Comments') }}</h5>
                    @include('admin.users.posts._comments')

                    {{-- appendig comments from js goes here --}}

                </div>

            </div>

        </div>
    </main>
@endsection

@push('scripts')

    <script type='text/javascript'>
        // comment clicked
        $('body').on('click', '.comments-icon', function() {
            var postId = $(this).data('post');
            var url = $(this).data('url');
            console.log(postId);


            $.ajax({
                url: url,
                success: function(comments) {
                    console.log('#comments-area-' + postId);
                    $('#comments-area-' + postId).append(comments);
                }
            });
        });

        // like clicked
        $('body').on('click', '.likes-icon', function() {

            var postId = $(this).data('post');
            var url = $(this).data('url');

            $.ajax({

                url: url,
                success: function(is_liked) {

                    if (is_liked) {

                        $('#heart-' + postId).addClass('filled-heart');

                    } else {

                        $('#heart-' + postId).removeClass('filled-heart');
                    }
                }
            });


        });



        // delete form 
    </script>
@endpush
