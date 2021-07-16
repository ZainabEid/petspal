@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Add New Admin') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::open(['route' => 'admin.admins.store', 'role' => 'form']) !!}

                @include('admin.admins._form')

                
            <div class="card-footer">
                {!! Form::submit( __('Create'), ['class' => 'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}

           

        </div>
    </main>
@endsection
