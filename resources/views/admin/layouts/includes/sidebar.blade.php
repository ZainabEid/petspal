<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <span class="align-middle">{{ __('PetsPals ') }}:: {{ __('Dashboard') }}</span>
        </a>

        <ul class="sidebar-nav">

            {{-- admins --}}
            @if (Auth::guard('admin')->user()->can('create_admin', 'read_admin', 'update_admin', 'delete_admin'))

                <li class="sidebar-header">
                    {{ __('Admins') }}
                </li>


                @if (Auth::guard('admin')->user()->can('read_admin'))

                    {{-- all admins --}}
                    <li class="sidebar-item @if (Request::is('admin/admins*')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.admins.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('All Admins') }}</span>
                        </a>
                    </li>
                @endif

                @if (Auth::guard('admin')->user()->can('read_role'))
                    {{-- permissions --}}
                    <li class="sidebar-item @if (Request::is('admin/roles*')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.roles.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('Permissions') }}</span>
                        </a>
                    </li>
                @endif


            @endif

            {{-- clinics --}}
            @if (Auth::guard('admin')->user()->can('create_clinics', 'read_clinics', 'update_clinics', 'delete_clinics'))

                <li class="sidebar-header">
                    {{ __('Clinics') }}
                </li>


                {{-- All clinics --}}
                @if (Auth::guard('admin')->user()->can('read_clinic'))
                    <li class="sidebar-item @if (Request::is('admin/clinics')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.clinics.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('Clinics') }}</span>
                        </a>
                    </li>
                @endif



                {{-- add clinic --}}
                @if (Auth::guard('admin')->user()->can('create_clinic'))
                    <li class="sidebar-item @if (Request::is('admin/clinics/create')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.clinics.create') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('Add Clinic') }}</span>
                        </a>
                    </li>
                @endif



                {{-- All clinics Category --}}
                @if (Auth::guard('admin')->user()->can('read_clinic_category'))
                    <li class="sidebar-item @if (Request::is('admin/clinics-categories*')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.clinics-categories.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('Clinics Categories') }}</span>
                        </a>
                    </li>
                @endif




            @endif


            {{-- pets category --}}
            @if (Auth::guard('admin')->user()->can('create_petscategory', 'read_petscategory', 'update_petscategory', 'delete_petscategory'))

                <li class="sidebar-header">
                    {{ __('pets') }}
                </li>



                {{-- All pets Category --}}
                @if (Auth::guard('admin')->user()->can('read_petscategory'))
                    <li class="sidebar-item @if (Request::is('admin/pets-categories*')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.pets-categories.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('pets Categories') }}</span>
                        </a>
                    </li>
                @endif


            @endif

            {{-- users --}}
            @if (Auth::guard('admin')->user()->can('create_users', 'read_users', 'update_users', 'delete_users'))

                <li class="sidebar-header">
                    {{ __('Users') }}
                </li>


                @if (Auth::guard('admin')->user()->can('read_users'))

                    {{-- all users --}}
                    <li class="sidebar-item @if (Request::is('admin/users')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('All Users') }}</span>
                        </a>
                    </li>

                    {{-- Add New User --}}
                    <li class="sidebar-item @if (Request::is('admin/users/create')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.users.create') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('Register User') }}</span>
                        </a>
                    </li>


                @endif


            @endif

            {{-- posts --}}
            @if (Auth::guard('admin')->user()->can('read_posts', 'update_posts', 'delete_users'))

                <li class="sidebar-header">
                    {{ __('Posts') }}
                </li>


                @if (Auth::guard('admin')->user()->can('read_posts'))

                    {{-- all posts --}}
                    <li class="sidebar-item @if (Request::is('admin/posts')) active @endif">
                        <a class="sidebar-link" href="{{ route('admin.posts.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span
                                class="align-middle">{{ __('All Posts') }}</span>
                        </a>
                    </li>

                @endif


            @endif





        </ul>


    </div>
</nav>
