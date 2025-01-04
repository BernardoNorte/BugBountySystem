<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bug Bounty System') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Bug Bounty System
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto">
                    </ul>


                    <ul class="navbar-nav ms-auto">

                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        </a>

                        <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                            width="45" height="45">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show', ['user' => Auth::user()]) }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div id="layoutSidenav" class="d-flex">

            <div id="layoutSidenav_nav" class="bg-white border-end" style="width: 180px;">
                <nav class="sb-sidenav accordion" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link"
                                href=" {{ route('reports.myReports') }}">
                                <div class="sb-sidenav-menu-heading"><i class="fas fa-home"></i></div>
                                My Reports
                            </a>
                            <a class="nav-link"
                                href=" {{ route('home') }}">
                                <div class="sb-sidenav-menu-heading"><i class="fas fa-home"></i></div>
                                Program List
                            </a>
                            <a class="nav-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Leaderboard
                            </a>
                        </div>
                    </div>
                </nav>
            </div>


            <div id="layoutSidenav_content" class="flex-fill">
                <main class="py-4">
                    @include('sweetalert::alert')
                    @yield('content')
                </main>
            </div>
        </div>
    </div>


</body>

</html>

<style>
    #layoutSidenav {
        height: 100%;
        display: list-item;
        overflow: hidden;
    }

    #layoutSidenav_nav {
        width: 180px;
        background-color: white;
        border-right: 1px solid #ddd;
        overflow-y: auto;
        padding-top: 30px;
    }

    #layoutSidenav_content {
        flex-grow: 1;
        overflow-y: auto;
        padding: 20px;
    }

    .nav-link {
        color: black !important;
        text-decoration: none !important;
        margin-bottom: 15px;
    }

    .nav-link:hover {
        color: #333 !important;
    }

    .sb-nav-link-icon {
        color: black;
    }

    body {
        min-height: 100vh;
        /* Garante que o corpo tenha altura mínima para evitar saltos */
    }
</style>