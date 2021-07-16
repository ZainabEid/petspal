@extends('admin.layouts.app')

@section('content')



 <main class="content">

        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{ __('Roles') }}</strong> </h1>

                <a href="{{ route('admin.roles.create') }}" class="btn btn-info">{{ __('Add New Role') }}</a>

            </div>

            <div class="row">
                <div class="col-12  d-flex">

                    <div class="card flex-fill">

                        <div class="card-header">

                            <h5 class="card-title mb-0">{{ __('Roles Table') }}</h5>

                        </div>

                        <table class="table table-hover my-0">

                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('permissions') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                 @if ($roles->count() > 0)

                                @foreach ($roles as $index => $role)

                                    <tr>
                                        <td>{{ $index + 1 }}.</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $index => $permission)
                                            {{ $index == 0 ? '' : ',' }}  {{ $permission->name }} 
                                            @endforeach
                                            </td>
                                        <td>
                                            <div class="row d-flex">

                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                   style=" text-decoration: none; color:orange;"> <i class="align-middle me-2"
                                                   data-feather="edit"></i>
                                                </a>

                                                {!! Form::open(['route' => ['admin.roles.destroy', $role->id], 'method' => 'delete', 'class' => 'delete']) !!}
                                                    @csrf
                                                    @method('DELETE')
                                                        
                                                    <a href="{{ route('admin.roles.destroy', $role->id) }}" type="submit"
                                                        style=" text-decoration: none; color:red;"> <i class="align-middle me-2"
                                                            data-feather="trash-2"></i> 
                                                    </a>
                                                {!! Form::close() !!}

                                               
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            @else
                                <tr>
                                    <td colspan="3">
                                        <p> {{ __('there is not data') }}</p>
                                    </td>
                                </tr>

                            @endif


                            
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>
    </main>

 
@endsection
