@extends('layouts.app')

@section('content')

@if(Auth::user())
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>{{ Auth::user()->name }}</strong></li>
</ol>
@endif
<form id="form_program" method="POST" action="{{ route('programs.store') }}" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
    @csrf
    <div class="col-md-6 mb-3 form-floating">
        <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name', $program->name) }}">
        <label for="inputName" class="form-label">Program name</label>
    </div>

    <div class="form-floating col-md-6 mb-3">
        <textarea class="form-control" name="description" id="inputDescription" rows="5" maxlength="5000">{{ old('description', $program->description) }}</textarea>
        <label for="inputDescription" class="form-label">Description</label>
    </div>

    <div class="form-floating col-md-6 mb-3">
        <textarea class="form-control" name="scope" id="inputScope" rows="5" maxlength="5000">{{ old('scope', $program->scope) }}</textarea>
        <label for="inputScope" class="form-label">Scope</label>
    </div>

    <div class="form-floating col-md-6 mb-3">
        <textarea class="form-control" name="rules" id="inputRules" rows="5" maxlength="5000">{{ old('rules', $program->rules) }}</textarea>
        <label for="inputRules" class="form-label">Rules & Guidelines</label>
    </div>

    <div class="col-md-6 mb-3 form-floating">
        <input type="number" step="0.01" class="form-control" name="rewards_info" id="inputReward" value="{{ old('rewards_info', $program->rewards_info) }}">
        <label for="inputReward" class="form-label">Reward</label>
    </div>

    <div class="col-md-6 mb-3 form-floating">
        <input type="date" class="form-control" name="date_limit" id="inputDateLimit" value="{{ old('date_limit', $program->date_limit) }}">
        <label for="inputDateLimit" class="form-label">Date Limit</label>
    </div>

    <div class="my-1 col-md-6 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" name="ok" form="form_program">Submit</button>
        <a href="{{ route('programs.create') }}" class="btn btn-secondary ms-3">Cancel</a>
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
