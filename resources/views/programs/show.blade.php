@extends('layouts.app')

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
                
                <div class="container-fluid mt-5">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $program->name }}</h2>
                                    <p class="text-muted">Created by <strong>{{ $program->user->name }}</strong> | Ends on {{ \Carbon\Carbon::parse($program->date_limit)->format('d/m/Y') }}</p>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <h5>Description</h5>
                                            <p class="card-text">{{ $program->description }}</p>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <h5>Scope</h5>
                                            <p class="card-text">{{ $program->scope }}</p>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <h5>Status</h5>
                                            <p class="card-text">
                                                @if(\Carbon\Carbon::parse($program->date_limit)->isFuture())
                                                <span class="btn btn-success btn-lg">Active</span>
                                                @else
                                                <span class="badge bg-danger">Closed</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <a class="btn btn-outline-danger btn-lg"
                                                href="{{ Auth::check() ? route('reports.custom', $program) : route('login') }}">
                                                <i class="fas fa-exclamation-triangle"></i> Report Vulnerability
                                            </a>

                                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">Back to Programs</a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Reward</h5>
                                    <div class="text-center mb-3">
                                        <i class="fas fa-coins fa-3x text-warning"></i>
                                    </div>
                                    <h2 class="text-center" style="font-size: 2.5rem; color: #28a745;">${{ number_format($program->rewards_info, 2) }}</h2>
                                    <p class="text-center text-muted">for valid reports</p>
                                </div>
                            </div>
                            <div class="card shadow-lg mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">Leaderboard - Top 3 Researchers</h3>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Researcher</th>
                                                    <th>Reports Submitted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $index => $user)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->reports_count }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-md-12">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Rules & Guidelines</h5>
                                    <textarea class="form-control" rows="6" maxlength="2000" readonly>{{ $program->rules }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

@endsection

<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 1rem;
        color: #666;
    }

    .badge {
        font-size: 1rem;
        padding: 8px 15px;
    }

    .btn-lg {
        border-radius: 50px;
        padding: 10px 30px;
    }

    .input-group input {
        border-radius: 30px;
    }

    .input-group button {
        border-radius: 30px;
    }

    .reward-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .reward-card .fa-coins {
        color: #ff9900;
    }

    .reward-card .text-success {
        color: #28a745 !important;
    }

    .reward-card h2 {
        font-size: 3rem;
        font-weight: bold;
    }

    textarea {
        resize: none;
    }
    #content-wrapper {
    margin-left: 200px;
    transition: margin 0.3s ease;
}

</style>