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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><strong>{{ $user->name }}</strong></li>
</ol>


        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
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

                    <div class="mb-3 form-floating">
                        @if($user->money == null)
                        <input type="text" class="form-control" name="money" id="inputMoney"
                            value="0.00€">
                        <label for="inputMoney" class="form-label">Money</label>
                        @else
                        <input type="text" class="form-control" name="money" id="inputMoney"
                            value="{{ old('money', $user->money) }}€">
                        <label for="inputMoney" class="form-label">Money</label>
                        @endif
                    </div>

                    <img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">
                    <div class="mb-3 pt-3">
                        <input type="file" class="form-control" name="file_foto" id="inputFileFoto">
                    </div>
                </div>
            </div>
        </div>

@endsection

<style>

    #content-wrapper {
        margin-left: 200px;
        transition: margin 0.3s ease;
    }

</style>
