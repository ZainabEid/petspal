@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('User\'s Block List') }}</h5>
            </div>

            <div class="card-body">
                
                @if( $users->count() > 0)

                <ul>
                    @foreach ($users as $user)
                        <li>
                            <div>
                                <img style="float: left;" src="{{ url($user->avatar) }}"
                                    width="30" height="30" class="rounded-circle me-2" alt="{{ $user->name }}">
                                <h5 style="float: left;">{{ $user->name }}</h5>
                            </div>
                        </li>
                    @endforeach
                    
                </ul>  
                    
                @else
                
                    <h6>{{ __('no data') }}</h6>
                @endif
            </div>
          

         

           

        </div>
    </main>
@endsection
