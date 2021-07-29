@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Add post') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::open(['route' => ['admin.users.posts.store', $user->id], 'role' => 'form','files'=>true]) !!}

        
            @include('admin.users.posts._form')


            <div class="card-footer">
                {!! Form::submit(__('Add'), ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}



        </div>
    </main>
@endsection
