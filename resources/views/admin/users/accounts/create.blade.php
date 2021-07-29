@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Add New Pet For Adoption') }}</h5>
            </div>

            <!-- form start -->
            {!! Form::open(['route' => ['admin.users.accounts.store', $user->id], 'role' => 'form', 'method' => 'post']) !!}


            @csrf
            @method('POST')

            <div class="card-body">

                <input type="hidden" name="user_id" value="{{ $user->id }}">


                {{-- Name --}}
                <div class="form-group mb-3">

                    {!! Form::label('name', __('Pet Name:'), ['class' => 'boldfont']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter pet name'), 'required' => 'required']) !!}

                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                {{-- Email --}}
                <div class="form-group mb-3">

                    {!! Form::label('email', __('Email:'), ['class' => 'boldfont']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter user email'), 'required' => 'required']) !!}

                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                {{-- pet category --}}
                <div class="form-group mb-3">
                    {!! Form::label('pets_category', __('Pet Category:'), ['class' => 'boldfont']) !!}

                    <select name="pets_category_id" class="form-control">
                        <option value="">{{ __('Choose Category:') }}</option>

                        @foreach ($pets_categories as $pets_category)

                            <option value="{{ $pets_category->id }}">
                                {{ $pets_category->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('pets_category_id') <span class="text-danger error">{{ $message }}</span>@enderror

                </div>

                <div class="card-footer">
                    {!! Form::submit(__('Add New Pet For Adoption'), ['class' => 'btn btn-success']) !!}
                </div>

            </div>

            {!! Form::close() !!}



        </div>
    </main>
@endsection
