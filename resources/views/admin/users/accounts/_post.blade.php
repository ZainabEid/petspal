@push('styles')
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

<div class="row">
    <div class="col-md-12">

        {{-- post header --}}
        <div class="d-flex flex-row justify-content-between ">

            {{-- author --}}
            <div>

                    <img style="float: left;" src="{{ url($post->author->avatar) ?? 'img/avatars/avatar-5.jpg' }}"
                        width="30" height="30" class="rounded-circle me-2" alt="{{ $post->author->name }}">
                    <h5 style="float: left;">{{ $post->author->name }}</h5>
            </div>
            <i class="align-middle" data-feather="more-horizontal"></i>

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


                <a class="carousel-control-prev" href="#postImage" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{ __('Previous') }}</span>
                </a>

                <a class="carousel-control-next" href="#postImage" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{ __('Next') }}</span>
                </a>
            </div>

            {{-- post body --}}
            <p>

                {{ $post->body }}


            </p>

        </div>

        {{-- post footer --}}
        <div class="row  d-flex justify-content-between">

            {{-- like & comment --}}
            <div class="">

                {{-- like count --}}
                <span class="likes-icon" data-post="{{ $post->id }}">

                    <i class="align-middle" data-feather="heart"></i>
                    <small>{{ $post->likes ? $post->likes->count() : 0 }}</small>
                </span>

                {{-- comments count --}}
                <a class="comments-icon" style="cursor: pointer;"
                    href="{{ route('admin.users.posts.show', [$post->author->id, $post->id]) }}">

                    <i class="align-middle" data-feather="message-square"></i>
                    <small>{{ $post->comments ? $post->comments->count() : 0 }}</small>
                </a>

                {{-- <span class="comments-icon" style="cursor: pointer;"
                            data-url="{{ route('admin.posts.comments.index', $post->id) }}"
                            data-postId="{{ $post->id }}">

                            <i class="align-middle" data-feather="message-square"></i>
                            <small>{{ $post->comments ? $post->comments->count() : 0 }}</small>
                        </span> --}}





            </div>

            {{-- time --}}
            <div class="">

                <span><small class="float-end text-navy">{{ $post->time ?? '5m ago' }}</small></span>

            </div>

        </div>


        {{-- comments --}}
        <div class="row comments-area-{{ $post->id }}">

            {{-- appendig comments from js goes here --}}

        </div>

    </div>

</div>
