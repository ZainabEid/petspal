@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{ __('All pets Category') }}</strong> </h1>

                @if (Auth::guard('admin')->user()->can('create_petscategory'))
                    <a href="{{ route('admin.pets-categories.create') }}" class="btn btn-info "> {{ __('Add New Pets Category') }}</a>
                @endif

            </div>

            <div class="row">
                <div class="col-12  d-flex">

                    <div class="card flex-fill">

                        <div class="card-header">

                            <h5 class="card-title mb-0">{{ __('Latest Pets Category') }}</h5>

                        </div>

                        <table class="table table-hover my-0">

                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Pets Counts') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($pets_categories as $pets_category)

                                    <tr>

                                        {{-- name --}}
                                        <td>
                                            <span> {{ $pets_category->name  }}  </span>
                                        </td>

                                        {{-- description --}}
                                        <td >
                                            <span> {{ $pets_category->description }} </span>
                                        </td>

                                        {{-- pets --}}
                                        <td>
                                            <span >{{ $pets_category->accounts()->count() }}</span>
                                        </td>

                                        {{-- action --}}
                                       
                                        <td class="d-none d-md-table-cell">
                                            @if (Auth::guard('admin')->user()->can('eidt_petscategory'))
                                                
                                                <a href="{{ route('admin.pets-categories.edit', $pets_category->id) }}"
                                                    style="text-decoration: none; color:orange;"> <i class="align-middle me-2"
                                                        data-feather="edit"></i> 
                                                </a>
                                            @endif

                                            @if (Auth::guard('admin')->user()->can('delete_petscategory'))
                                                {!! Form::open(['route' => ['admin.pets-categories.destroy', $pets_category->id], 'method' => 'post', 'class' => 'delete']) !!}
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    
                                                    <button type="submit" style="border:none; background: none; text-decoration: none; color:red;">
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
