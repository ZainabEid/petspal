@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Edit post') }}</h5>
            </div>


            {{-- create comment --}}
            <div class="card-body">
                <div class="media mt-4 col-md-12 text-center">
                    {!! Form::model($comment,['route' => ['admin.posts.comments.update', [$post->id, $comment->id]], 'role' => 'form']) !!}
                    @csrf
                    @method('PUT')
                    {{-- body --}}
                    <div class="media-body">

                        {!! Form::text('body', null) !!}

                    </div>

                    {!! Form::submit(__('Edit'), ['class' => 'btn btn-info']) !!}
                    {!! Form::close() !!}
                </div>
            </div>




        </div>
    </main>
@endsection
