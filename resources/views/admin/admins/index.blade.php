@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{ __('All Admins') }}</strong> </h1>

                <a href="{{ route('admin.admins.create') }}" class="btn btn-info "> {{ __('Add New Admin') }}</a>


            </div>

            <div class="row">
                <div class="col-12  d-flex">

                    <div class="card flex-fill">

                        <div class="card-header">

                            <h5 class="card-title mb-0">{{ __('Latest admins') }}</h5>

                        </div>

                        <table class="table table-hover my-0">

                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($admins as $admin)

                                    <tr>

                                        {{-- name --}}
                                        <td>
                                            <span href="#" data-url="{{ route('admin.admins.inline-update') }}" class="xedit"
                                                data-pk="{{ $admin->id }}" data-name="name" style="border: none;">
                                                {{ $admin->name }}
                                            </span>

                                            
                                        </td>

                                        {{-- email --}}
                                        <td >
                                            <span href="#" data-url="{{ route('admin.admins.inline-update') }}" class="xedit"
                                                data-pk="{{ $admin->id }}" data-name="email" style="border: none;">

                                                {{ $admin->email }}
                                            </span>
                                        </td>

                                        {{-- role --}}
                                        <td>
                                            <span >
                                                {{ $admin->role }}</span>
                                        </td>

                                        {{-- action --}}
                                        <td class="d-none d-md-table-cell">
                                            @if (Auth::guard('admin')->user()->can('eidt_admin'))
                                                
                                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class=""
                                                    style="@if($admin->role == 'super_admin')  display:none; @endif text-decoration: none; color:orange;"> <i class="align-middle me-2"
                                                        data-feather="edit"></i> </a>
                                            @endif

                                            @if (Auth::guard('admin')->user()->can('delete_admin'))
                                                {!! Form::open(['route' => ['admin.admins.destroy', $admin->id], 'method' => 'post', 'class' => 'delete']) !!}
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    
                                                    <button type="submit" style="@if($admin->role == 'super_admin')  display:none; @endif  border:none; background: none; text-decoration: none; color:red;">
                                                        <i class="align-middle me-2" data-feather="trash-2"></i> 
                                                    </button>
                                                {!! Form::close() !!}
                                            @endif
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
