<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>@yield('title')</title>

    <meta name="keywords"
        content="e-learning, laravel, orionpro, revanapriyandi, M. Revan Apriyandi, M Revan Apriyandi, Elearning, Laravel Elearning, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Argon Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, soft design, soft dashboard bootstrap 5 dashboard, CBT, cbt">
    <meta name="description" content="Elearning dengan Laravel ">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="{{ asset('assets/js/fontawesome.com.js') }}" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.5') }}" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>

</head>

<body class="error-page">
    <main class="main-content  mt-0">
        <div class="page-header min-vh-100" style="background-image: url('https://w.wallha.com/ws/14/SnOvWEZT.jpg');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-7 mx-auto text-center">
                        <h1 class="display-1 text-bolder text-primary">@yield('code')</h1>
                        <h2>@yield('message')/h2>
                            @if ($code == 419)
                                <a href="{{ route('login') }}" class="btn bg-gradient-dark mt-4 animate-hover">Login</a>
                            @elseif ($code == 404)
                                <a href="{{ route('home') }}" class="btn bg-gradient-dark mt-4 animate-hover">Home</a>
                            @elseif($code == 503)
                                <p class="lead">Silahkan hubungi admin.</p>
                                <a href="https://revanapriyandi.tech/"
                                    class="btn bg-gradient-dark mt-4  animate-hover">Chat Admin</a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                    <a href="https://revanapriyandi.tech/" target="_blank"
                        class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Company
                    </a>
                </div>
                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-dribbble"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                        <span class="text-lg fab fa-github"></span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Soft by OrionPro.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script src="{{ asset('assets/js/argon-dashboard.min9c7f.js?v=2.0.5') }}"></script>
</body>

</html>
