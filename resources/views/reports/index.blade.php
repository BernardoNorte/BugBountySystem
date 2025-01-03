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

            <div id="content">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Report Listing</h1>
                        <form class="form-inline" method="GET" action="{{ route('reports.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="title" id="nameInput" placeholder="Filter by Title"
                                    value="{{ old('title', $titleFilter) }}">
                                <button type="submit" class="btn btn-primary mr-3" name="filtrar">Filter</button>
                                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Clear</a>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Tabela de Relatórios -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Researcher</th>
                                <th>Title</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $report->user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 40px; height: 40px; margin-right: 10px;">
                                        <span>{{ $report->user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->severity }}</td>
                                <td>{{ $report->status }}</td>
                                <td>
                                    <a class="btn btn-outline-primary" href="{{ route('reports.show', $report) }}">Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div>
                    {{ $reports->withQueryString()->links() }}
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
