@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>{{ $report->title }}</strong></li>
</ol>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Report Details</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="title"><strong>Report Title</strong></label>
                        <p>{{ $report->title }}</p>
                    </div>

                    <div class="form-group">
                        <label for="program"><strong>Program</strong></label>
                        <p>{{ $report->program ? $report->program->name : 'N/A' }}</p>
                    </div>

                    <div class="form-group">
                        <label for="description"><strong>Description</strong></label>
                        <p>{{ $report->description }}</p>
                    </div>

                    <div class="form-group">
                        <label for="severity"><strong>Severity</strong></label>
                        <p>{{ $report->severity }}</p>
                    </div>

                    <div class="form-group">
                        <label for="status"><strong>Status</strong></label>
                        <p>{{ $report->status }}</p>
                    </div>

                    <div class="form-group">
                        <label for="proof_of_concept"><strong>Proof of Concept</strong></label>
                        @if($report->proof_of_concept)
                            <a href="{{ $report->fullAttachmentURL }}" download>Download Proof of Concept</a>
                        @else
                            <p>No Proof of Concept available</p>
                        @endif
                    </div>

                    <div class="my-3">
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    #layoutSidenav {
        height: 100%;
        display: flex;
        overflow: hidden;
    }

    #layoutSidenav_nav {
        width: 150px;
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

    .navbar {
        z-index: 1000;
    }
</style>
