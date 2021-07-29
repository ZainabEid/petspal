@extends('admin.layouts.app')

@push('styles')

<style>
    .filled-heart{
        fill:#be0000;
        stroke-width:0;
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

        <div class="row">
            <div class="col-md-12">
                
                 {{-- choose comment auther from users --}}
                 {{-- <div class="align-self-stretch p-2 m-1">

                    {!! Form::label('user_id', __('Comment Writer:'), ['class' => 'boldfont']) !!}

                    <select id="user" data-url="{{ route('admin.users.posts.change-user') }}" name="user_id" class="form-select" aria-label="select example">
                        <option selected value="{{ null }}">
                            <label for="user_id" class="boldfont">{{ __('Choose User') }}</label>
                        </option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="card p-4 text-center d-flex align-items-center">

                    {{-- post header --}}
                    <div class=" d-flex flex-row justify-content-between align-items-center ">

                        {{-- author --}}
                        <div >
                            <img src="{{ url($post->author->avatar) }}" width="30" height="30" class="rounded-circle me-2"
                                alt="{{ $post->author->name }}">

                            <h5>{{ $post->author->name }}</h5>

                        </div>

                        {{-- menue --}}
                        <div class="float-end text-navy">

                            <i class="align-middle" data-feather="more-horizontal"></i>
                            {{-- edit post --}}
                            {{-- delete post --}}

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

                                        <img class="d-block" width="100px" height="100px" style="width:100,height:100"
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
                            {!! $post->body !!}
                        </p>

                    </div>

                    {{-- post footer --}}
                    <div class="row  d-flex justify-content-between">

                        {{-- like & comment --}}
                        <div class="">

                            {{-- {{$user->hasLiked($post)  ? 'true' : 'false' }} --}}
                            


                            {{-- like count --}}
                            <span class="likes-icon" data-post="{{ $post->id }}" data-url="{{ route('admin.posts.like', [$post->id ,$users->first()->id]) }}">
                                <i id="heart-{{ $post->id }}" class="align-middle" data-feather="heart" ></i>
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
                                <small class="float-end text-navy">{{ $post->getTimeAgo($post->created_at)}}</small>
                            </span>

                        </div>

                    </div>
                    <hr class="my-0" />
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
                    <div class="row " id="comments-area-{{ $post->id }}">

                       @include('admin.users.posts._comments')

                        {{-- appendig comments from js goes here --}}

                    </div>










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

                    }else{

                        $('#heart-' + postId).removeClass('filled-heart');
                    }
                }
            });

           
        });

        // user changed
        $('body').on('change','#user', function () {
            // get user id 

            var user_id = $(this).val();
            var url = $(this).data('url');
            // send user id to post show
            $.ajax({
                url: url,
                data: {user_id:user_id},
                success: function (response) {
                    console.log(response);
                }
            });
            // run post show again with user
        });
    </script>
@endpush
