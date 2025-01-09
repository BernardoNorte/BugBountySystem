@extends('layouts.app')

@section('content')

@if(Auth::user())
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>New Report</strong></li>
</ol>
@endif

<form id="form_report" method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
    @csrf
    <div class="col-md-6 mb-3 form-floating">
        <input type="text" class="form-control" name="title" id="inputReport" value="{{ old('title', $report->title) }}">
        <label for="inputReport" class="form-label">Report Title</label>
    </div>

    <div class="form-group col-md-6 mb-3 form-floating">
        <input type="text" class="form-control" id="inputProgramName" value="{{ $program->name }}" readonly>
        <label for="inputProgramName" class="form-label">Program</label>
        <input type="hidden" name="program_id" value="{{ $program->id }}">
    </div>


    <div class="form-floating col-md-6 mb-3">
        <textarea class="form-control" name="description" id="inputDescription" rows="5" maxlength="5000">{{ old('description', $report->description) }}</textarea>
        <label for="inputDescription" class="form-label">Description</label>
    </div>

    <div class="form-floating col-md-6 mb-3">
        <textarea class="form-control" name="stepsToReproduce" id="inputStepsToReproduce" rows="5" maxlength="5000">{{ old('steps_to_reproduce', $report->steps_to_reproduce) }}</textarea>
        <label for="inputStepsToReproduce" class="form-label">Steps to reproduce</label>
    </div>

    <div class="form-group col-md-6 mb-3 form-floating">
        <select id="inputDescription" class="form-control" name="severity">
            <option {{ old('severity', $report->severity) == 'Low' ? 'selected' : '' }}>Low</option>
            <option {{ old('severity', $report->severity) == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option {{ old('severity', $report->severity) == 'High' ? 'selected' : '' }}>High</option>
            <option {{ old('severity', $report->severity) == 'Critical' ? 'selected' : '' }}>Critical</option>
        </select>
        <label for="inputDescription" class="form-label">Severity</label>
    </div>

    <div class="pt-3 col-md-6 mb-3">
        <input type="file" class="form-control" name="file_attachment" id="inputFileAttachment">
    </div>

    <div class="my-1 col-md-6 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" name="ok" form="form_report">Submit</button>

        <a href="{{ url()->current() == route('reports.custom', $program) ? route('programs.show', $program->id) : route('reports.create') }}" class="btn btn-secondary ms-3">
            Cancel
        </a>
    </div>
</form>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
</body>

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
        /* Move os itens para baixo */
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
        /* Adiciona espaçamento entre os itens */
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