@extends('layouts.app')

@section('subtitulo')
<p>Bug Bounty System</p>
@endsection

@section('content')

<script src="vendor/jquery/jquery.min.js" defer></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
<script src="vendor/jquery-easing/jquery.easing.min.js" defer></script>
<script src="vendor/chart.js/Chart.min.js" defer></script>
<script src="js/demo/chart-area-demo.js" defer></script>
<script src="js/demo/chart-pie-demo.js" defer></script>

<body id="page-top">
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">
            @if(Auth::user() && Auth::user()->type == 'E')
            <div class="d-flex justify-content-center mb-4 text-center">
                @if(Auth::check())
                <a class="btn btn-outline-primary"
                    href="">
                    <i class="fas fa-plus-circle"></i> Create New Program</a>
                @else
                <a class="btn btn-outline-primary"
                    href="{{ route('login') }}">
                    <i class="fas fa-plus-circle"></i> Create New Program</a>
                @endif
            </div>
            @elseif(Auth::user() && Auth::user()->type == 'C')
            <div class="d-flex justify-content-center mb-4 text-center">
                @if(Auth::check())
                <a class="btn btn-outline-danger"
                    href="{{ route('reports.create') }}">
                    <i class="fas fa-exclamation-triangle"></i> Report Vulnerability</a>
                @else
                <a class="btn btn-outline-danger"
                    href="{{ route('login') }}">
                    <i class="fas fa-exclamation-triangle"></i> Report Vulnerability</a>
                @endif
            </div>
            @elseif(!Auth::check())
            <div class="d-flex justify-content-center mb-4 text-center">
                <a class="btn btn-outline-danger"
                    href="{{ route('login') }}">
                    <i class="fas fa-exclamation-triangle"></i> Report Vulnerability</a>
            </div>
            @endif




            <div id="content">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Program Listing</h1>
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="nameInput" placeholder="Filter by Name"
                                    value="{{ old('name', $nameFilter) }}">
                                <button type="submit" class="btn btn-primary mr-3" name="filtrar">Filter</button>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Clear</a>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="row">
                    @foreach ($programs as $program)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">

                                        <div class="d-flex align-items-center">
                                            <img src="{{ $program->user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 40px; height: 40px; margin-right: 10px;">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $program->user->name }}</div>
                                        </div>

                                        <hr>

                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $program->name }}</div>

                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Reward
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $program->rewards_info }} €</div>

                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            Created at {{ $program->created_at->format('d/m/Y') }}
                                        </div>

                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-danger">
                                            Ends in {{ floor(now()->diffInDays($program->date_limit)) }} days
                                        </div>

                                        <hr>
                                        <div class="text-center">
                                            <td><a class="btn btn-outline-primary"
                                                    href="{{ route('programs.show', ['program' => $program]) }}">
                                                    Details </a>
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bug fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    {{ $programs->withQueryString()->links() }}
                </div>
            </div>

        </div>

    </div>
</body>

@endsection

<style>
    #content-wrapper {
        margin-left: 200px;
        transition: margin 0.3s ease;
    }
</style>