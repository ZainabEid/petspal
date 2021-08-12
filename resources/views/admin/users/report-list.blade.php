@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('User\'s Block List') }}</h5>
            </div>

            <div class="card-body">
                
                @if( $reports->count() > 0)

                <ul>
                    @foreach ($reports as $report)
                        <li>
                            <p>
                                {{ __('this user reported ') }}
                                
                                <a href="{{ route('admin.users.accounts.show',[$user->id,$user->account()->id]) }}">
                                    <img style="float: left;" src="{{ url($report->reported->avatar) }}"
                                        width="30" height="30" class="rounded-circle me-2" alt="{{ $report->reported->name }}">
                                    <h5 style="float: left;">{{ $report->reported->name }}</h5>
                                </a>
                                {{ __('for') }}</p>
                                <strong>{{ $report->reported->reason ?? '' }}</strong>
                            </p>
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
