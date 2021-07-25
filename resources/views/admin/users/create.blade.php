@extends('admin.layouts.app')

@push('styles')
    @livewireStyles
    <style>
        .display-none {
            display: none;
        }

        .multi-wizard-step p {
            margin-top: 12px;
        }

        .stepwizard-row {
            /* display: table-row; */
        }

        .stepwizard {
            /* display: table; */
            position: relative;
            /* width: 100%; */
        }

        .multi-wizard-step button[disabled] {
            filter: alpha(opacity=100) !important;
            opacity: 1 !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            content: " ";
            width: 100%;
            height: 1px;
            z-order: 0;
            position: absolute;
            background-color: #fefefe;
        }

        .multi-wizard-step {
            text-align: center;
            position: relative;
            display: table-cell;
        }

    </style>
@endpush

@section('content')
    <main class="content">

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Register New User') }}</h5>
            </div>

                
            @livewire('user-form-wizard', ['pets_categories'=>$pets_categories])







        </div>
    </main>

@endsection

@push('scripts')
    @livewireScripts
@endpush
