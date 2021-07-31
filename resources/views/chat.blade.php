@extends('admin.layouts.app')
@section('header')
    
<title>{{ __('Admin Live chat') }}</title>
@endsection

@section('content')
<main class="content">

    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between mb-2 ">

            <h1 class="h3 mb-3"><strong>{{ __('Admin Live chat') }}</strong> </h1>

        </div>

        <div class="row">
            <div class="col-12  d-flex">

                <div class="card flex-fill">

                    <div class="card-header">

                        <h5 class="card-title mb-0">{{ __('lets talk') }}</h5>            

                    </div>

                    <div class="card-body">
                        <input type="text" name="username" id="username" placeholder="please inter your username...">
              
                        <div id="messages">
              
                        </div>
              
                        <form id="messageform">
                            @csrf
                            @method('POST')
                            <input type="text" name="message" placeholder="wirte a message..." id="message_input">
                            <button type="submit" id="message_send">Send Message</button>
                        </form>
                    </div>

                  

                </div>

            </div>

        </div>

    </div>
</main>

  @push('scripts')
  <script  type="module"  src="{{ asset('js/chat.js') }}"></script>
  @endpush
@endsection
