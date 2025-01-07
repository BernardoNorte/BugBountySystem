@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    @if(Auth::user()->type == 'C')
    <li class="breadcrumb-item"><a href="{{ route('reports.myReports') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>{{ $report->title }}</strong></li>
    @else
    <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>{{ $report->title }}</strong></li>
    @endif
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
                        <label for="title"><strong>Submitted by</strong></label>
                        <p>{{ $report->user->name }}</p>
                    </div>
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
                        <label for="stepsToReproduce"><strong>Steps To Reproduce</strong></label>
                        <p>{{ $report->steps_to_reproduce }}</p>
                    </div>

                    <div class="form-group">
                        <label for="severity"><strong>Severity</strong></label>
                        <p>{{ $report->severity }}</p>
                    </div>

                    <div class="form-group">
                        <label for="status"><strong>Status</strong></label>
                        @if($report->status == 'in_review')
                        <p>In Review</p>
                        @else
                        <p>{{ $report->status }}</p>
                        @endif
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
                        @if((Auth::user()->type == 'A' || Auth::user()->type == 'E') && ($report->status == 'Open' || $report->status == 'in_review'))
                        <form method="POST" action="{{ route('reports.updateStatus', $report) }}" style="display: inline;">
                            @csrf
                            @method('PATCH')

                            <button type="submit" name="status" value="Resolved" class="btn btn-success">Resolve</button>
                            <button type="submit" name="status" value="Rejected" class="btn btn-danger">Reject</button>
                        </form>
                        @endif

                        @if(Auth::user()->type == 'C')
                        <a href="{{ route('reports.myReports') }}" class="btn btn-secondary">Back to Reports</a>
                        @else
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection