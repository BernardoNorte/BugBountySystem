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

                <div class="table-responsive">
                    @if($reports->getCollection()->isEmpty())
                    <p class="text-center">N/A Reports</p>
                    @else
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Researcher</th>
                                <th>Program</th>
                                <th>Title</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                @if(Auth::user()->type != 'C' && isset($report->user->fullPhotoUrl))
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $report->user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 40px; height: 40px; margin-right: 10px;">
                                        <span>{{ $report->user->name }}</span>
                                    </div>
                                </td>
                                @else
                                <td>No Photo</td>
                                <span>{{ $report->user->name }}</span>
                                @endif
                                @if(Auth::user()->type != 'C' && $report->program)
                                <td>{{ $report->program->name }}</td>
                                @else
                                <td>No Program associated</td>
                                @endif

                                <td>{{ $report->title }}</td>
                                <td>{{ $report->severity }}</td>
                                <td style="width: 10%;">
                                    <form method="POST" action="{{ route('reports.updateStatus', $report) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="Open" {{ $report->status == 'Open' ? 'selected' : '' }}>Open</option>
                                            <option value="in_review" {{ $report->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                                            <option value="Resolved" {{ $report->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="Rejected" {{ $report->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('reports.show', $report) }}">Details</a>
                                    @if(!$report->program && $report->status == 'Resolved')
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#payModal-{{ $report->id }}">
                                        Pay
                                    </button>
                                    @endif
                                </td>
                            </tr>


                            <div class="modal fade" id="payModal-{{ $report->id }}" tabindex="-1" aria-labelledby="payModalLabel-{{ $report->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="payModalLabel-{{ $report->id }}">Pay Report</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to pay for the report titled "{{ $report->title }}"?</p>

                                            <form method="POST" action="{{ route('reports.pay', $report) }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="paymentAmount-{{ $report->id }}" class="form-label">Amount to Pay</label>
                                                    <input type="number" class="form-control" id="paymentAmount-{{ $report->id }}" name="payment_amount" placeholder="Enter amount" min="0" step="0.01" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Pay</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

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
