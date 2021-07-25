@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Edit Admin') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::model( $user , ['route'=> ['admin.users.update', $user->id ], 'role' => 'form', 'method' => 'PUT']) !!}

               
                @csrf
                @method('PUT')

                @include('admin.users._form')

                

                
                <div class="card-footer">
                    {!! Form::submit( __('Update'), [ 'class' => 'btn btn-success']) !!}
                </div>

            {!! Form::close() !!}

           

        </div>
    </main>
@endsection
