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

                </div>

                <div class="table-responsive">
                    @if($reports->isEmpty())
                    <p>N/A reports found</p>
                    @else
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th style="width: 200px;">Actions</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->severity }}</td>
                                @if($report->status != 'in_review')
                                <td>{{ $report->status }}</td>
                                @else
                                <td>In Review</td>
                                @endif
                                <td class="text-center">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('reports.show', $report) }}">Details</a>
                                    @if($report->status == 'Open' || $report->status == 'in_review')
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('reports.edit', $report) }}">Edit</a>
                                    @else
                                    @endif
                                    <form method="POST" action="{{ route('reports.destroy', ['report' => $report]) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                    
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @endif
                </div>


                @if(!$reports->isEmpty())
                <div>
                    {{ $reports->withQueryString()->links() }}
                </div>
                @endif
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