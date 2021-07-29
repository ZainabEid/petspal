@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Edit Clinic') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::model( $clinic , ['route'=> ['admin.clinics.update', $clinic->id ], 'role' => 'form', 'method' => 'PUT', 'files' => true]) !!}
               
                @csrf
                @method('PUT')

                @include('admin.clinics.includes._form')


                
                <div class="card-footer">
                    {!! Form::submit( __('Update'), [ 'class' => 'btn btn-success']) !!}
                </div>

            {!! Form::close() !!}

           

        </div>
    </main>
@endsection
