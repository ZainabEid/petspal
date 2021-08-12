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

                            <tbody id="data-wrapper">

                                <!-- Results -->
                        
                               


                            </tbody>
                             
                        </table>

                        <!-- Data Loader -->
                        <div class="auto-load text-center">
                            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                <path fill="#000"
                                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </main>


    @push('scripts')
    {{-- load more scripts  --}}
    <script>
        var ENDPOINT = "{{ url('/admin/users') }}";
        
    </script>

    <script src="{{ asset('js/load-more.js') }}"></script>

    @endpush
@endsection
