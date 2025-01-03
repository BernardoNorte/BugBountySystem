@extends('layouts.app')

@section('content')

<body id="page-top">
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column" style="margin-left: 250px;">


            <div id="content">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <div class="mb-3 form-floating">
                    <input type="text" class="form-control " name="createdBy" id="inputCreatedBy"
                        value="{{ old('created_by', $program->user->name) }}">
                    <label for="inputCreatedBy" class="form-label">Created By</label>
                    
                </div>

                <div class="mb-3 form-floating">
                    <input type="text" class="form-control " name="name" id="inputName"
                        value="{{ old('name', $program->name) }}">
                    <label for="inputName" class="form-label">Program Name</label>
                    
                </div>


            </div>

        </div>

    </div>



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
        width: 250px; 
        background-color: white;
        border-right: 1px solid #ddd;
        overflow-y: auto; 
        padding-top: 30px; /* Move os itens para baixo */
    }

    #layoutSidenav_content {
        flex-grow: 1;
        overflow-y: auto; 
        padding: 20px;
    }

    .nav-link {
        color: black !important; 
        text-decoration: none !important; 
        margin-bottom: 15px; /* Adiciona espaçamento entre os itens */
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