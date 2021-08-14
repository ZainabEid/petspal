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

                <!-- 
                    on_click:
                        1. clear this messages area 
                        2. select the talked admin (using search when write name)
                        3. click start chating btn
                -->

                <a href="{{ route('admin.conversations.create') }}"  class="btn btn-info "> 
                    <i  class="align-middle" data-feather="user-plus"></i> 
                    {{-- {{ __('Start A New Chat') }} --}}
                </a>
               
            </div>
    
            <!-- Content wrapper start -->
            <div class="content-wrapper">
    
                <!-- Row start -->
                <div class="row gutters">
    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    
                        <div class="card m-0">
    
                            <!-- Row start -->
                            <div class="row no-gutters">

                                {{-- left side : search and users  --}}
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                                    <div class="users-container">

                                        {{-- search for user  --}}
                                        <div class="chat-search-box">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Search">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-info">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        {{-- users list  --}}
                                        <ul class="users">
                                            {{-- $conversations : all brevious chat rooms  --}}
                                            @isset($conversations)
                                            @if ($conversations->count() > 0)
                                            
                                                @foreach ($conversations as $chat)
                                                    <li class="person" data-chat="{{ $chat->id }}" data-url="{{ route('admin.conversations.index' ) }}" >

                                                        <div class="user">
                                                            <img src="{{ $chat->talked_admin->avatar  ?? 'https://www.bootdey.com/img/Content/avatar/avatar3.png' }}" alt="Retail Admin">
                                                            {{-- <span class="status busy"></span> --}}
                                                        </div>

                                                        <p class="name-time">
                                                            <span class="name">{{ $chat->talked_admin->name }}</span>
                                                            <span class="time">{{ $chat->lastMessageTime()->format('d/m/Y') }}</span>
                                                        </p>

                                                    </li>

                                                @endforeach
                                            @else
                                                <p class="text-danger">  {{ __('There is no conversation yet') }}</p>
                                            @endif
                                            @endisset


                                            {{-- if no conversations  --}}
                                            @if (! isset($conversations))
                                            <li class="person" data-chat="person1">
                                                <p> {{ __('no conversations') }}</p>
                                            </li>

                                            @endif
                                          
                                        </ul>
                                      
                                    </div>
                                </div>


                                {{-- right side massenger --}}
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">

                                    {{-- sellected admin conversation  --}}
                                    <div id="conversation-container">

                                        <!-- appended conversation goes here -->

                                    </div>
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

@push('scripts')

    <script>
        $(document).ready(function () {
            
            // {{-- on load show messages of the last conversatoin --}}
            var url = '{{ route("admin.conversations.index") }}';
            var conversation_id = '{{ $conversations->last()->id }}';
            loadConversation(conversation_id,url);
            

            // {{-- on click show messages of this conversatoin --}}
            $('body').on('click','.person',function(e){
                e.preventDefault();

                var url = $(this).data('url');
                var conversation_id = $(this).data('chat');
                loadConversation(conversation_id,url);

            });


            function loadConversation(conversation_id,url){
                $.ajax({
                    url: url,
                    data:{
                        conversation_id:conversation_id
                    },
                    success: function (response) {
                        $('#conversation-container').empty();
                        $('#conversation-container').append(response);
                    }
                });
            }
        });
    </script>
   

@endpush

@endsection
