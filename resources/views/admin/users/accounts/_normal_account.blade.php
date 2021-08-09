<div class="row">

    {{-- left side profile and user details --}}
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3">

            {{-- profile details header --}}
            <div class="card-header d-flex justify-content-between">

                <h5 class="card-title mb-0">{{ __('Profile Details') }}</h5>

                {{-- dropdown 3dots --}}
                <div class="3dots">
                    <li class="dropdown" style=" list-style-type: none;">


                        <a class=" d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="more-vertical"></i>
                        </a>


                        <div class="dropdown-menu dropdown-menu-end">

                            {{-- switch-account --}}
                            <a class="dropdown-item"
                                href="{{ route('admin.users.accounts.switch-account', [$account->id]) }}">
                                {{ __('switch to Adoption') }}
                            </a>

                            {{-- block --}}
                            <a class="dropdown-item" href="">
                                {{ __('Block') }}
                            </a>

                            {{-- report --}}
                            <a class="dropdown-item" href="">
                                {{ __('Report') }}
                            </a>

                            <div class="dropdown-divider"></div>

                            {{-- deactivate --}}

                            <a class="dropdown-item" href="{{ route('admin.users.accounts.destroy', [$account->user->id , $account->id]) }}">
                                {{ $account->user->account()->id === $account->id ?  __('Deactivate') : __('Remove') }}
                            </a>

                        </div>
                    </li>
                </div>


            </div>


            {{-- update account form open --}}
            @if (Auth::guard('admin')->user()->can('update_accounts'))

                {!! Form::model($account, ['id' => 'update-account-form', 'method' => 'post', 'files' => true, 'route' => ['admin.users.accounts.update', [$account->user->id, $account->id]]]) !!}

                @csrf
                @method('PATCH')

            @endif

            {{-- editabel avatar - name - type - follow btn --}}
            <div class="card-body text-center">

                {{-- avatar --}}
                <div class="account-avatar">

                    <div onclick="document.getElementById('image').click()" class="account-avatar-overlay">

                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px"
                            height="50px">
                            <path
                                d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 14 6 L 36 6 C 40.430666 6 44 9.5693339 44 14 L 44 36 C 44 40.430666 40.430666 44 36 44 L 14 44 C 9.5693339 44 6 40.430666 6 36 L 6 14 C 6 9.5693339 9.5693339 6 14 6 z M 21.132812 12 C 20.079884 12 19.101556 12.55485 18.560547 13.457031 L 16.724609 16.513672 C 16.542289 16.815645 16.218154 17 15.867188 17 L 11 17 C 9.9069372 17 9 17.906937 9 19 L 9 35 C 9 36.093063 9.9069372 37 11 37 L 39 37 C 40.093063 37 41 36.093063 41 35 L 41 19 C 41 17.906937 40.093063 17 39 17 L 34.132812 17 C 33.779742 17 33.456382 16.817444 33.275391 16.515625 A 1.0001 1.0001 0 0 0 33.275391 16.513672 L 31.439453 13.457031 C 30.898444 12.55485 29.919615 12 28.867188 12 L 21.132812 12 z M 12 14 C 11.448 14 11 14.448 11 15 L 11 16 L 15 16 L 15 15 C 15 14.448 14.552 14 14 14 L 12 14 z M 21.132812 14 L 28.867188 14 C 29.21876 14 29.543618 14.182556 29.724609 14.484375 A 1.0001 1.0001 0 0 0 29.724609 14.486328 L 31.558594 17.542969 C 32.099603 18.445103 33.079884 19 34.132812 19 L 39 19 L 39 35 L 11 35 L 11 19 L 15.867188 19 C 16.919615 19 17.897599 18.446016 18.439453 17.544922 A 1.0001 1.0001 0 0 0 18.441406 17.542969 L 20.275391 14.486328 A 1.0001 1.0001 0 0 0 20.275391 14.484375 C 20.456335 14.18265 20.779742 14 21.132812 14 z M 25 20 C 21.145849 20 18 23.145852 18 27 C 18 30.854148 21.145849 34 25 34 C 28.854151 34 32 30.854148 32 27 C 32 23.145852 28.854151 20 25 20 z M 34 20 A 1 1 0 0 0 34 22 A 1 1 0 0 0 34 20 z M 25 22 C 27.773271 22 30 24.226731 30 27 C 30 29.773269 27.773271 32 25 32 C 22.226729 32 20 29.773269 20 27 C 20 24.226731 22.226729 22 25 22 z" />
                        </svg>
                    </div>


                    <img src="{{ url($account->avatar) }}" alt="{{ $account->name }}"
                        class="img-fluid rounded-circle mb-2" width="128" height="128" />

                    <input onchange="document.getElementById('update-account-form').submit()" style="display: none; "
                        type="file" name="image" id="image">

                </div>

                {{-- name --}}
                <h5 class="card-title mb-0">{{ $account->name }}</h5>

                {{-- type --}}
                <div class="text-muted mb-2">
                    {{ $account->type }}
                </div>

                {{-- Followers & Following --}}
                <div class="d-flex justify-content-around mb-2">
                    <div class="pr-2 "><strong>{{ $account->user->followers()->count() }}</strong>
                        <small>{{ __('followers') }}</small>
                    </div>
                    <div class="pr-2 "><strong>{{ $account->user->following()->count() }}</strong>
                        <small>{{ __('following') }}</small>
                    </div>
                </div>


                {{-- add adaption pets --}}
                <div>
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.users.accounts.create', $account->user->id) }}">{{ __('Add New Pet For Adoption') }}</a>
                </div>


            </div>

            <hr class="my-0" />

            {{-- Account Data --}}
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <h5 class="h6 card-title">{{ __('Account Details') }}</h5>

                    {{-- show edit modal btn --}}
                    <span class="text-info show-modal" style="cursor: pointer;">
                        <i class=" text-info align-middle me-2" data-feather="edit"></i>
                    </span>

                    @include('admin.users.accounts._modal')

                </div>


                {{-- Account Details --}}
                <div class="list-unstyled mb-0">

                    <div class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>
                        {{ __('Name:') }}
                        <span>{{ $account->name }}</span>
                    </div>

                    <div class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                        {{ __('Email:') }} <span>{{ $account->email }}</span></div>

                    <div class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                        {{ __('Type:') }} <span>{{ $account->type }}</span></div>

                    <div class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                        {{ __('Category:') }} <span>{{ $account->category->name }}</span></div>

                </div>

            </div>

            {{-- form end --}}
            @if (Auth::guard('admin')->user()->can('update'))
                </form>
            @endif

            {{-- recent 6 posts --}}
            @if (isset($account->recent_posts))

                <hr class="my-0" />

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <h5 class="h6 card-title">{{ 'Recent Posts' }}</h5>

                        <div class="pr-2 ">
                            <a href="#all-posts">
                                {{ $account->user->posts()->count() }}
                                <small>{{ __('posts') }}</small>
                            </a>
                        </div>

                    </div>

                    <div class="row">
                        @foreach ($account->recent_posts as $post)
                            <div class="inline-flex">
                                <img src="{{ url( $post->thumbnail ) }}" class="img-fluid mb-2" width="50"
                                                height="50" />
                            </div>
                        @endforeach
                    </div>

                </div>

            @endif

            <hr class="my-0" />


            {{-- User Data --}}
            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <h5 class="h6 card-title">{{ __('User') }}</h5>

                    <a href="{{ route('admin.users.edit', $account->id) }}" style="text-decoration: none; ">
                        <i class=" text-info align-middle me-2" data-feather="edit"></i>
                    </a>






                </div>



                <div class="list-unstyled mb-0">

                    <div class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>
                        {{ __('Name:') }}
                        <span>{{ $account->user->name }}</span>
                    </div>

                    <div class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                        {{ __('Email:') }} <span>{{ $account->user->email }}</span></div>

                </div>

            </div>

            <hr class="my-0" />


            @if ($account->user->accounts->count() > 1)

                {{-- Other Accounts --}}
                <div class="card-body">

                    <h5 class="h6 card-title">{{ __('Other Accounts') }}</h5>

                    @foreach ($account->user->accounts as $other_account)


                        <div class="mb-1">

                            <img src="{{ url($other_account->avatar) }}" class="img-fluid rounded-circle mb-2"
                                width="30" height="30" />

                            <a
                                href="{{ route('admin.users.accounts.show', [$account->user->id, $other_account->id]) }}">{{ $other_account->name }}</a>
                        </div>


                    @endforeach

                </div>

            @endif


        </div>
    </div>

    {{-- right side posts --}}
    <div class="col-md-8 col-xl-9">

        {{-- posts --}}
        <div id="all-posts">
            <div class="card">

                <div class="card-header d-flex justify-content-between">

                    <h5 class="card-title mb-0">{{ __('Posts') }}</h5>
                    
                    {{-- <a href="{{ route('admin.users.posts.create', $account->user->id )}}" class="card-title mb-0">{{ __('add post') }}</a> --}}

                </div>

                <div class="card-body h-100">

                    @if (isset($posts) && $posts->count() > 0)

                        @foreach ($posts as $index => $post)

                            {!! $index != 0 ? '<hr />' : '' !!}


                            {{-- post component --}}
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">

                                    {{-- post component --}}
                                  @include('admin.users.accounts._post')

                                
                                </div>
                            </div>

                        @endforeach

                        {{ $posts->links() }}
                    @else
                        <div class="d-flex align-items-start">
                            {{ __('There is no data yet !') }}
                        </div>
                    @endif



                </div>
            </div>
        </div>
    </div>


</div>
