@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{ __('All Users') }}</strong> </h1>

                <a href="{{ route('admin.users.create') }}" class="btn btn-info "> {{ __('Register New User') }}</a>


            </div>

            <div class="row">
                <div class="col-12  d-flex">

                    <div class="card flex-fill">

                        <div class="card-header">

                            <h5 class="card-title mb-0">{{ __('Latest users') }}</h5>

                        </div>

                        <table class="table table-hover my-0">

                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Accounts') }}</th>

                                    <th>{{ __('Delete') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($users as $user)

                                    <tr>

                                        {{-- name --}}
                                        <td><span>{{ $user->name }}</span></td>

                                        {{-- Email --}}
                                        <td><span> {{ $user->email }} </span> </td>

                                        {{-- Type --}}
                                        <td><span> {{ $user->account()->type }} </span> </td>

                                        {{-- Category --}}
                                        <td><span>{{ $user->account()->category->name }}</span> </td>

                                        {{-- Accounts --}}
                                        <td>
                                            @foreach ($user->accounts as $account)

                                                <ul class="list-unstyled mb-0">

                                                    <li class="mb-1">

                                                        <img src="{{ url($account->avatar) }}"
                                                            class="img-fluid rounded-circle mb-2" width="30" height="30" />

                                                        <a href="{{ route('admin.users.accounts.show', [$user->id, $account->id]) }}">{{ $account->name }}</a>

                                                    </li>

                                                </ul>

                                            @endforeach

                                        </td>



                                        {{-- Delete --}}
                                        <td class="d-flex  d-md-table-cell">

                                            @if (Auth::guard('admin')->user()->can('delete_user'))

                                                <button type="submit" class="text-danger"
                                                    onclick="Document.getElementById('DeleteUser').submit()"
                                                    style=" border:none; background: none; text-decoration: none; ">
                                                    <i class="align-middle me-2" data-feather="trash-2"></i>
                                                </button>
                                            @endif

                                            {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'post', 'class' => 'delete', 'id' => 'DeleteUser']) !!}
                                            @csrf
                                            @method('DELETE')


                                            {!! Form::close() !!}

                                        </td>
                                    </tr>

                                @endforeach



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>
    </main>


@endsection
