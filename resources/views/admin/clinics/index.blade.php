@extends('admin.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
@endpush
@section('content')
    <main class="content">

        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between mb-2 ">

                <h1 class="h3 mb-3"><strong>{{ __('All Clinics') }}</strong> </h1>

                @if (Auth::guard('admin')->user()->can('create_clinic'))
                    <a href="{{ route('admin.clinics.create') }}" class="btn btn-info "> {{ __('Add New Clinic') }}</a>
                @endif

            </div>

            <div class="row">


                <div class="col-12  d-flex">

                    <div class="card flex-fill">

                        <div class="card-header">

                            <h5 class="card-title mb-0">{{ __('Latest Clinics') }}</h5>

                        </div>

                        <table class="table table-hover my-0">

                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Social') }}</th>
                                    <th>{{ __('Working Hours') }}</th>
                                    <th>{{ __('Phones') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Media') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($clinics as $clinic)

                                    <tr>

                                        {{-- name --}}
                                        <td>
                                            <span> {{ $clinic->name }} </span>
                                        </td>


                                        {{-- description --}}
                                        <td>
                                            <span> {{ $clinic->description }} </span>
                                        </td>


                                        {{-- address --}}
                                        <td>
                                            <span> {{ $clinic->address }} </span>

                                        </td>


                                        {{-- Social --}}
                                        <td>
                                            <a href="{{ $clinic->twitter }}" style="text-decoration: none;"> <i
                                                    class="align-middle" data-feather="twitter"></i> </a>
                                            <a href="{{ $clinic->facebook }}" style="text-decoration: none;"> <i
                                                    class="align-middle" data-feather="facebook"></i> </a>
                                            <a href="{{ $clinic->instagram }}" style="text-decoration: none;"> <i
                                                    class="align-middle" data-feather="instagram"></i> </a>

                                        </td>

                                        {{-- working_hours --}}
                                        <td>
                                            {{-- show working time  btn --}}
                                            <span class="text-info show-modal" style="cursor: pointer;"
                                                data-url="{{ route('admin.clinics.show-working-hours', $clinic->id) }}">
                                                {{ __('view') }}
                                            </span>


                                        </td>


                                        {{-- phones --}}
                                        <td>
                                            @foreach ($clinic->phones as $index => $phone)

                                                <span> {{ $index > 0 ? ',' : '' }}{{ $phone['phone'] }} </span>

                                            @endforeach
                                        </td>



                                        {{-- rate --}}
                                        <td>
                                            <span> {{ $clinic->rate }} </span>
                                        </td>


                                        {{-- gallery --}}
                                        <td>
                                            {{-- show gallery btn --}}
                                            <span class="text-info show-modal" style="cursor: pointer;"
                                                data-url="{{ route('admin.clinics.show-gallery', $clinic->id) }}">
                                                {{ __('view') }}
                                            </span>
                                           

                                        </td>


                                        {{-- clinics_categrory_id --}}
                                        <td>
                                            <span> {{ $clinic->category->name }} </span>
                                        </td>


                                        {{-- action --}}
                                        <td class="d-none d-md-table-cell">
                                            @if (Auth::guard('admin')->user()->can('edit_clinic'))

                                                <a href="{{ route('admin.clinics.edit', $clinic->id) }}"
                                                    style="text-decoration: none;"> <i
                                                        class=" text-warning align-middle me-2" data-feather="edit"></i>
                                                </a>
                                            @endif

                                            @if (Auth::guard('admin')->user()->can('delete_clinic'))
                                                {!! Form::open(['route' => ['admin.clinics.destroy', $clinic->id], 'method' => 'post']) !!}
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-danger"
                                                    style="border:none; background: none; text-decoration: none;">
                                                    <i class="   align-middle me-2" data-feather="trash-2"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach



                            </tbody>
                            
                        </table>






                        {{-- modal --}}
                        <div class="modal" id="clinic-modal">
                            <div class="modal-background"></div>
                            <div id="to-append">
                                {{-- appended card goes here --}}
                            </div>
                        </div>


                        
                    </div>

                </div>

            </div>

        </div>
    </main>


@endsection

@push('scripts')
    <script type='text/javascript'>
       
        $(document).ready(function() {

            $('body').on('click', '.show-modal', function() {

                var url = $(this).data('url');

                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    success: function(modal_card) {

                        $('#to-append').append(modal_card);
                        $('.modal').addClass('is-active');
                    }
                });

            });



            $('body').on('click', '.delete', function() {

                $('.modal').removeClass('is-active');
                $('#to-append').empty();

            });

            

        });
    </script>
@endpush
