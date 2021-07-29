@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Edit post') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::model($post,['route' => ['admin.users.posts.update', [$user->id,$post->id]], 'role' => 'form','files'=>true]) !!}

        @method('PUT')
            @include('admin.users.posts._form')


            <div class="card-footer">
                {!! Form::submit(__('Add'), ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}



        </div>
    </main>
@endsection
