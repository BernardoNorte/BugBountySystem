<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bug Bounty System') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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
                        <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle" width="45" height="45">
                        @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="me-2">
                                    @if(Auth::user()->money == null && Auth::user()->type == 'C')
                                    0.00€
                                    @elseif(Auth::user()->type == 'C')
                                    {{ Auth::user()->money }}€
                                    @endif
                                </span>
                                {{ Auth::user()->name }}
                            </a>

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
                        @endauth
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div id="layoutSidenav" class="d-flex">


            <div id="layoutSidenav_nav" class="bg-white border-end" style="width: 180px; height: 100vh; overflow-y: auto;">
                <nav class="sb-sidenav accordion" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav" style="display: flex; flex-direction: column;">
                            @auth
                            @if(Auth::user()->type == 'C')
                            <a class="nav-link" href=" {{ route('reports.myReports') }}">
                                <div class="sb-sidenav-menu-heading"><i class="bi bi-flag-fill"></i></div>
                                My Reports
                            </a>
                            <a class="nav-link" href=" {{ route('rewards.myRewards') }}">
                                <div class="sb-sidenav-menu-heading"><i class="bi bi-wallet"></i></div>
                                Transaction History
                            </a>
                            @else
                            <a class="nav-link" href=" {{ route('reports.index') }}">
                                <div class="sb-sidenav-menu-heading"><i class="bi bi-flag-fill"></i></div>
                                Reports
                            </a>
                            <a class="nav-link" href=" {{ route('rewards.myRewards') }}">
                                <div class="sb-sidenav-menu-heading"><i class="bi bi-wallet"></i></div>
                                Payments
                            </a>
                            @endif
                            @endauth
                            <a class="nav-link" href=" {{ route('home') }}">
                                <div class="sb-sidenav-menu-heading"><i class="fas fa-home"></i></div>
                                Program List
                            </a>
                            <a class="nav-link" href=" {{ route('leaderboard.index') }}">
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
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    #layoutSidenav_nav {
        min-height: 100vh;
        position: sticky;
        top: 0;
        overflow-y: auto;
    }


    #layoutSidenav_content {
        flex-grow: 1;
        padding: 20px;
    }

    .navbar {
        min-height: 50px;
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

    #layoutSidenav_nav {
        height: 100vh;
        overflow-y: auto;
    }


    .sb-sidenav-menu .nav {
        display: flex;
        flex-direction: column;
    }
</style>
