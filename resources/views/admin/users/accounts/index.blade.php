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
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($accounts as $account)

                                    <tr>

                                        {{-- name --}}
                                        <td>
                                            <span style="border: none;">
                                                {{ $account->name }}
                                            </span>
                                        </td>

                                        {{-- email --}}
                                        <td>
                                            <span style="border: none;">
                                                {{ $account->email }}
                                            </span>
                                        </td>

                                         {{-- type --}}
                                         <td>
                                            <span style="border: none;">
                                                {{ $account->is_adoption }}
                                            </span>
                                        </td>

                                        {{-- category --}}
                                        <td>
                                            <span style="border: none;">
                                                {{ $account->category }}
                                            </span>
                                        </td>


                                        {{-- action --}}
                                        <td class="d-flex  d-md-table-cell">

                                            @if (Auth::guard('admin')->user()->can('show_account'))

                                                <a href="{{ route('admin.users.accounts.show', $account->id) }}" class="text-info"
                                                    style="text-decoration: none; ;"> <i class="align-middle me-2"
                                                        data-feather="eye"></i> </a>
                                            @endif


                                            @if (Auth::guard('admin')->user()->can('delete_account'))

                                                <button type="submit" onclick="Document.getElementById('DeleteUser').submit()"
                                                    style=" border:none; background: none; text-decoration: none; color:red;">
                                                    <i class="align-middle me-2" data-feather="trash-2"></i>
                                                </button>

                                            @endif

                                            {!! Form::open(['route' => ['admin.users.destroy', $account->id], 'method' => 'post', 'class' => 'delete', 'id'=>'DeleteUser']) !!}
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
