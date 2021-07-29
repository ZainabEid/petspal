@extends('admin.layouts.app')

@section('content')


<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">{{ __('Profile') }}</h1>
            
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('Profile Details') }}</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="http://lorempixel.com/128/128/people/1" alt="{{ $admin->name }}"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h5 class="card-title mb-0">{{ $admin->name }}</h5>


                        <div class="text-muted mb-2">{{ $admin->role }}</div>

                        {{-- messages --}}

                        {{-- <div>
                            <a class="btn btn-primary btn-sm" href="#"><span
                                    data-feather="message-square"></span> {{ __('Message') }}</a>
                        </div> --}}

                    </div>
                   
                   
                    <hr class="my-0" />

                    <div class="card-body">
                        <h5 class="h6 card-title">{{ __('About') }}</h5>
                        <ul class="list-unstyled mb-0">

                            {{-- address --}}
                            {{-- <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>
                                {{ __('Lives in')}} <a href="#">{{ $admin->address }}</a>
                            </li> --}}
                                
                            {{-- email --}}
                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                                {{ __('email') }} <a href="#">{{ $admin->email }}</a>
                            </li>

                            {{-- phone --}}
                            {{-- <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>
                                From <a href="#">{{ $admin->phone }}</a></li> --}}

                        </ul>
                    </div>
                   
                </div>
            </div>

            
        </div>

    </div>
</main>
   

 
@endsection
