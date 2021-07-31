<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PetsPals') }} :: Admin</title>

    <!-- Styles -->
    <link href="{{ Lang::locale() == 'ar' ? asset('dist/css/app.rtl.css') : asset('dist/css/app.css') }}" rel="stylesheet">

    <!-- Fonts & icons -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('dist/img/icons/icon-48x48.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    @stack('styles')

    <!--jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- app bootstrap js -->
    {{-- <script src="{{ asset('js/bootstrap.js') }}"></script> --}}

    <!--inline Edit -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet" />
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script> --}}

    {{-- pusher --}}
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
   
</head>

<body dir="{{ Lang::locale() == 'ar' ? 'rtl' : '' }}">

    <div  id="app" class="wrapper">

        @include('admin.layouts.includes.sidebar')

        <div class="main">

            @include('admin.layouts.includes.header')


            @if ($errors->any())
                <div class="alert text-danger">
                    @foreach ( $errors->all() as $error )
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @yield('content')

            @include('admin.layouts.includes.footer')

        </div>

    </div>

    {{-- jqurey  --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- bootstrap --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    @stack('scripts')


    <script src="{{ asset('dist/js/app.js') }}"></script>
    
    <script>
        console.disableYellowBox = true;
    </script> 

   
</body>

</html>
