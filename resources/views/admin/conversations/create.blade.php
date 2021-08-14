@extends('admin.layouts.app')

@push('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endpush

@section('content')
    
<main class="content">

    <div class="container-fluid p-0">

      
        <div class="container">
    
            <!-- Page header-->
            <div class="page-title d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{  __('Admins Massenger') }}</strong> </h1>

            </div>
    
            <!-- Content wrapper start -->
            <div class="content-wrapper">
    
                <!-- Row start -->
                <div class="row gutters">
    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
                        <div class="card m-0">
    
                            <!-- Row start -->
                            <div class="row no-gutters">


                                <div class="card-header">
                                    <h5>
                                        {{ __('Start New Coversation') }}
                                    </h5>

                                    
                                    <form action="{{ route('admin.conversations.store') }}" method="post">

                                        @csrf
                                        @method('POST')


                                        {{-- select admin to start conversation with  --}}
                                        <div class="form-group mb-3">
                                            <select name="selected_user_id" id="selected_user" class="form-control">
                                                <option value="">{{ __('Who do you want to talk to ?') }}</option>
                                                @foreach ($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <br>    

                                        {{-- choose  --}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info form-control">{{ __('Start Conversation') }}</button>
                                        </div>



                                    </form>
                                </div>


                                <div class="card-body">
                                  
                                </div>
                              


                            </div>
                            <!-- Row end -->
                        </div>
    
                    </div>
    
                </div>
                <!-- Row end -->
    
            </div>
            <!-- Content wrapper end -->
    
        </div>

    </div>
</main>
@endsection
