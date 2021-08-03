{{-- isset($comments()) && $comments->count() > 0 --}}
@if (true)
    @foreach ($comments as $comment)
        <div class="card row mt-4  ml-5  col-md-8  ">


            {{-- comment author --}}
            <div class=" d-flex justify-content-between align-items-center">

                <div>
                    <a class="pr-3" href="#">
                        <img style="float: left;" class="rounded-circle" alt=" {{ $comment->author->name }}" width="30" height="30"
                            src="{{ $comment->author->avatar }}" />
                    </a>
    
                    <h5 style="float: left;">{{ $comment->author->name }}</h5>

                </div>

                 {{-- 3dots menue --}}
                 <div class="float-end 3dots-menue">

                    <div class=" text-navy">
                        <li class="dropdown" style=" list-style-type: none;">


                            <a class=" d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="more-horizontal"></i>
                            </a>


                            <div class="dropdown-menu dropdown-menu-end">

                                {{-- edit comment --}}
                                <a class="dropdown-item"
                                    href="{{ route('admin.posts.comments.edit', [$post->id, $comment->id]) }}">
                                    {{ __('Edit Comment') }}
                                </a>

                                {{-- delete comment --}}
                                <form id="comment-delete-form"
                                    action="{{ route('admin.posts.comments.destroy', [$post->id, $comment->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="dropdown-item"
                                        onclick="document.getElementById('comment-delete-form').submit()"
                                        href=" {{ route('admin.posts.comments.destroy', [$post->id, $comment->id]) }}">
                                        {{ __('Delete Comment') }}
                                    </button>

                                </form>



                            </div>
                        </li>
                    </div>
                </div>
            </div>

            <div class="card-body">

                {{ $comment->body }}
                
            </div>
            
            <div class="card-footer">
                <span>{{ $comment->getTimeAgo($comment->created_at) }}</span>

            </div>
        </div>
    @endforeach

    {{ $comments->links() }}
@endif
