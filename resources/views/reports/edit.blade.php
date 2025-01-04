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
                    <h3>Edit Report</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reports.update', $report) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title"><strong>Report Title</strong></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $report->title) }}">
                        </div>

                        <div class="form-group">
                            <label for="program"><strong>Program</strong></label>
                            <select class="form-control" id="program" name="program_id">
                                <option value="">Select Program</option>
                                @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id', $report->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description"><strong>Description</strong></label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $report->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="stepsToReproduce"><strong>Steps To Reproduce</strong></label>
                            <textarea class="form-control" id="stepsToReproduce" name="stepsToReproduce" rows="3">{{ old('steps_to_reproduce', $report->steps_to_reproduce) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="severity"><strong>Severity</strong></label>
                            <select class="form-control" id="severity" name="severity">
                                <option value="low" {{ old('severity', $report->severity) == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('severity', $report->severity) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('severity', $report->severity) == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="proof_of_concept"><strong>Proof of Concept</strong></label>
                            <input type="file" class="form-control" id="proof_of_concept" name="file_attachment">

                        </div>

                        <div class="my-3">
                            <button type="submit" class="btn btn-primary">Update Report</button>
                            @if(Auth::user()->type == 'C')
                            <a href="{{ route('reports.myReports') }}" class="btn btn-secondary">Back to Reports</a>
                            @else
                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
                            @endif
                        </div>
                    </form>
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