@isset($messages)
    
@foreach ($messages as $message)
                                                                    
    {{-- message from auth_user --}}
    @if ( $message->sender->id === Auth::guard('admin')->id())

        <li class="chat-left">

            <div class="chat-avatar">

                <img src="{{ $message->sender->avatar ?? 'https://www.bootdey.com/img/Content/avatar/avatar3.png' }}" alt="{{ $message->sender->name }}">
                <div class="chat-name">{{ $message->sender->name }}</div>
                
            </div>

            <div class="chat-text">{!! $message->message_content !!}</div>

            <div class="chat-hour">

                {{  $message->time_ago  }}

                {{-- seen  --}}
                {{-- <span class="fa fa-check-circle"></span> --}}

            </div>
        </li>
        
    @else{{-- message from talked_admin --}}

        
        <li class="chat-right">
            <div class="chat-hour">

                {{  $message->time_ago ?? '08:55' }}

                {{-- seen  --}}
                {{-- <span class="fa fa-check-circle"></span> --}}

            </div>
            <div class="chat-text">{!! $message->content !!}</div>
            <div class="chat-avatar">
                <img src="{{ $message->sender->avatar}}" alt="{{ $message->sender->name }}">
                <div class="chat-name">{{ $message->sender->name }}</div>
            </div>
        </li>
    @endif

@endforeach
@endisset