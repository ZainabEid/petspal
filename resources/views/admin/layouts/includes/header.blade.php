<nav class="navbar navbar-expand navbar-light navbar-bg">

    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">

        <ul class="navbar-nav navbar-align">

            {{-- language  --}}
            <li class="nav-item ">
                
                <a class="nav-link"
                    href="{{ route('admin.change-lang', Lang::locale() == 'ar' ? 'en' : 'ar') }}">
                    {{ Lang::locale() == 'ar' ? 'en' : 'ar' }}
                </a>
                
            </li>

            {{-- messages --}}
            <li class="nav-item dropdown">
                
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                <!--
                    {{-- new message count  --}}
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                             {{Auth::guard('admin')->user()->lastNewMessages() ? Auth::guard('admin')->user()->lastNewMessages()->count() : '0'  }} 
                             {{ __('New Messages') }}
                        </div>
                    </div>

                    {{-- list of latest 4 messages  --}}
                    <div class="list-group">
                        {{-- $lastNewMessages : last 4  chat rooms -> for each find last message --}}
                        @if (Auth::guard('admin')->user()->lastNewMessages() !== null)
                            
                            @foreach (Auth::guard('admin')->user()->lastNewMessages() as $message)
                                <a href="#" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <img src="{{ $message->author->avater ??  asset('img/avatars/avatar-5.jpg') }}" class="avatar img-fluid rounded-circle" alt="{{ $message->author->name }}">
                                        </div>
                                        <div class="col-10 ps-2">
                                            <div class="text-dark">{{ $message->author->name }}</div>
                                            <div class="text-muted small mt-1">{{ $message->message }}</div>
                                            <div class="text-muted small mt-1">{{ $message->time_ago ?? '15m ago' }}</div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        
                    </div>
                -->

                    {{-- view all messages link  --}}
                    <div class="dropdown-menu-footer">
                        <a href="{{ route('admin.conversations.index') }}" class="text-muted">{{ __('Show all messages') }}</a>
                    </div>

                </div>
            </li>
           

            {{-- user : profile and logout --}}
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{Auth::guard('admin')->user()->avatar }}" class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" />
                        
                        <span class="text-dark">{{ Auth::guard('admin')->user()->name }} </span>
                </a>


                {{-- profile and logout --}}
                <div class="dropdown-menu dropdown-menu-end">

                    {{-- profile --}}
                    <a class="dropdown-item" href="{{ route('admin.admins.show' , Auth::guard('admin')->id()) }}"><i class="align-middle me-1"
                            data-feather="user"></i> {{ __('Profile') }}</a>

        
                    <div class="dropdown-divider"></div>

                    {{-- logout --}}
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>

    </div>
</nav>