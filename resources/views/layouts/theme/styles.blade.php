<link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/js/loader.js')}}"></script>
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/structure.css')}}" rel="stylesheet" type="text/css" class="structure" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" class="dashboard-sales" />

<link href="{{asset('assets/css/apps/scrumboard.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/css/apps/notes.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style>
    aside{
        display: none !important;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #3b3f5c ;
        border-color: #3b3f5c;
    }
    @media (max-width: 480px) {
        .mtmobile{
            margin-bottom: 20px !important;
        }
        .mbmobile{
            margin-bottom: 10px !important;
        }
        .hideonsm{
            display: none !important;
        }
        .inblock{
            display: block;
        }
    }

    .snackbar-top-right {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 9999;
        width: 500px; /* Hacerlo un poco más ancho */
        height: 50px;
        opacity: 0.9; /* Un poco transparente */
        margin-right: 350px;
    }




</style>
<link href="{{asset('plugins/flatpickr/flatpickr.dark.css')}}" rel="stylesheet" type="text/css">
@livewireStyles


