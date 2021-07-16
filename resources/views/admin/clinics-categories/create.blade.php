@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Add New Clinic Category') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::open(['route' => 'admin.clinics-categories.store', 'role' => 'form']) !!}

                @include('admin.clinics-categories._form')

                
            <div class="card-footer">
                {!! Form::submit( __('Create'), ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}

           

        </div>
    </main>
@endsection
