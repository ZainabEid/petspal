@isset($conversation->messages)
    
@foreach ($conversation->messages as $message)
                                                                    
    {{-- message from auth_user --}}
    @if ( $message->auther->id === Auth::guard('admin')->id())

        <li class="chat-left">
            <div class="chat-avatar">
                <img src="{{ $message->auther->avatar ?? 'https://www.bootdey.com/img/Content/avatar/avatar3.png' }}" alt="{{ $message->auther->name }}">
                <div class="chat-name">{{ $message->auther->name }}</div>
            </div>
            <div class="chat-text">{!! $message->content !!}</div>
            <div class="chat-hour">

                {{  $message->time_ago ?? '08:55' }}

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
                <img src="{{ $message->auther->avatar  ?? 'https://www.bootdey.com/img/Content/avatar/avatar3.png' }}" alt="{{ $message->auther->name }}">
                <div class="chat-name">{{ $message->auther->name }}</div>
            </div>
        </li>
    @endif

@endforeach
@endisset