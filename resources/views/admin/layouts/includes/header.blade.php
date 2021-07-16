<nav class="navbar navbar-expand navbar-light navbar-bg">

    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">

        <ul class="navbar-nav navbar-align">
            <li class="nav-item ">
                
                <a class="nav-link"
                    href="{{ route('admin.change-lang', Lang::locale() == 'ar' ? 'en' : 'ar') }}">
                    {{ Lang::locale() == 'ar' ? 'en' : 'ar' }}
                </a>
                
            </li>
           

            {{-- user --}}
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                    data-bs-toggle="dropdown">
                    {{-- <img src="{{ asset('img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" /> --}}
                        
                        <span class="text-dark">{{ Auth::guard('admin')->user()->name }} </span>
                </a>


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