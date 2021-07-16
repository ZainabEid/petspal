@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Edit Pet Category') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::model( $pets_category , ['route'=> ['admin.pets-categories.update', $pets_category->id ], 'role' => 'form', 'method' => 'PUT']) !!}

               
                @csrf
                @method('PUT')

                @include('admin.pets-categories._form')

                

                
                <div class="card-footer">
                    {!! Form::submit( __('Update'), [ 'class' => 'btn btn-success']) !!}
                </div>

            {!! Form::close() !!}

           

        </div>
    </main>
@endsection
