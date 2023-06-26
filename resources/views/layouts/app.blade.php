<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="keywords" content="#">
    <meta name="description" content="#.">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="{{ asset('assets/js/fontawesome.com.js') }}" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css" rel="stylesheet" />

    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.5') }}" rel="stylesheet" />
    @stack('top-script')
    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>

</head>

<body @auth class="g-sidenav-show   bg-gray-100" @endauth>
    @php
        if (session()->has('success')) {
            toastr()->success(session('success'));
        } elseif (session()->has('error')) {
            toastr()->error(session('error'));
        } elseif (session()->has('warning')) {
            toastr()->warning(session('warning'));
        } elseif (session()->has('info')) {
            toastr()->info(session('info'));
        }
    @endphp
    @auth
        <div class="position-absolute w-100 min-height-300 top-0"
            style="background-image: url('https://as2.ftcdn.net/v2/jpg/02/05/91/75/1000_F_205917532_6B2whGPwy8e0ljdgmlg8GnW5qqJ9sOhp.jpg'); background-position-y: 50%;">
            <span class="mask bg-primary opacity-6"></span>
        </div>
        @if (!request()->is('mod/exam/*'))
            @include('layouts.partials.aside')
        @endif
        <main class="main-content position-relative border-radius-lg ">

            @include('layouts.partials.navbar')
            <div class="container-fluid py-4">

                @yield('content')
                @stack('modal')

                @include('layouts.partials.footer')
            </div>
        </main>

    @endauth

    @guest
        <div class="h-100 bg-gradient-primary position-absolute w-100"></div>
        @extends('layouts.partials.auth')

        @slot('contentauth')
            @yield('contentauth')
        @endslot
    @endguest

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/sl-1.6.2/datatables.min.js">
    </script>
    <script src="https://cdn.tiny.cloud/1/22ggrcqb6va20uggnc5m53g9xj11lpdz09eho2u3e3urpzgt/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="{{ asset('assets/js/argon-dashboard.min9c7f.js?v=2.0.5') }}"></script>
    @stack('scripts')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
</body>

</html>
