@extends('layouts.app')


@section('content')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>{{ $user->name }}</strong></li>
</ol>

<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="name" id="inputNome"
        value="{{ old('name', $user->name) }}">
    <label for="inputNome" class="form-label">Name</label>

</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="email" id="inputEmail"
        value="{{ old('email', $user->email) }}">
    <label for="inputEmail" class="form-label">Email</label>
</div>

<img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">
<div class="mb-3 pt-3">
    <input type="file" class="form-control" name="file_foto"
        id="inputFileFoto">
</div>


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