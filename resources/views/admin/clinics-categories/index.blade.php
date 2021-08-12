@extends('admin.layouts.app')

@section('content')
    <main class="content">

        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{ __('All clinics Category') }}</strong> </h1>

                @if (Auth::guard('admin')->user()->can('create_clinics_category'))
                    <a href="{{ route('admin.clinics-categories.create') }}" class="btn btn-info "> {{ __('Add New Clinics Category') }}</a>
                @endif

            </div>

            <div class="row">
                <div class="col-12  d-flex">

                    <div class="card flex-fill">

                        <div class="card-header">

                            <h5 class="card-title mb-0">{{ __('Latest Clinics Category') }}</h5>

                        </div>

                        <table class="table table-hover my-0">

                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Clincis Counts') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($clinics_categories as $clinic_category)

                                    <tr>

                                        {{-- name --}}
                                        <td>
                                            <span> {{ $clinic_category->name }} </span>
                                        </td>

                                        {{-- description --}}
                                        <td >
                                            <span> {{ $clinic_category->description }} </span>
                                        </td>

                                        {{-- clinics --}}
                                        <td>
                                            <span >{{ $clinic_category->clinics()->count() }}</span>
                                        </td>

                                        {{-- action --}}
                                        <td class="d-flex  d-md-table-cell">
                                            <div>

                                                @if (Auth::guard('admin')->user()->can('eidt_clinic_category'))
                                                    
                                                    <a href="{{ route('admin.clinics-categories.edit', $clinic_category->id) }}"
                                                        style="text-decoration: none; color:orange;"> <i class="align-middle me-2"
                                                            data-feather="edit"></i> 
                                                    </a>
                                                @endif
                                            </div>

                                            <div>
                                                
                                                @if (Auth::guard('admin')->user()->can('delete_clinic_category'))
                                                    {!! Form::open(['route' => ['admin.clinics-categories.destroy', $clinic_category->id], 'method' => 'post', 'class' => 'delete']) !!}
                                                        @csrf
                                                        @method('DELETE')
                                                            
                                                        <button type="submit" style="border:none; background: none; text-decoration: none; color:red;">
                                                            <i class="align-middle me-2" data-feather="trash-2"></i> 
                                                        </button>
                                                    {!! Form::close() !!}
                                                @endif
                                            </div>

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
