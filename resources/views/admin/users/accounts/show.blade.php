@extends('admin.layouts.app')
@push('styles')

    <style>
        .account-avatar {

            position: relative;
            /* border: 1px solid rgba(0, 0, 0, 0.125); */
            cursor: pointer;

        }

        .account-avatar-overlay:hover {
            fill: #fff;
            position: absolute;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.4);
        }

    </style>
@endpush
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">{{ __('Profile') }}</h1>
            </div>

            @if ($account->is_adoption)
                @include('admin.users.accounts._adoption_account')

            @else
                @include('admin.users.accounts._normal_account')

            @endif


        </div>
    </main>


    @push('scripts')
        {{-- load more script --}}
        <script src="{{ asset('js/load-more.js') }}"></script>


        <script type='text/javascript'>
            $(document).ready(function() {

                // append form to model
                $('body').on('click', '.show-modal', function() {

                    $('.modal').addClass('is-active');

                });

                // submit model
                $('body').on('click', '.show-modal', function() {

                    $('.modal').addClass('is-active');

                });



                $('body').on('click', '.delete', function() {

                    $('.modal').removeClass('is-active');

                });



            });
        </script>
    @endpush

@endsection
