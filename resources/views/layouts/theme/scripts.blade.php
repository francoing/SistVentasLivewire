<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
        noty('Snackbar cargado correctamente');
    });
</script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
<script src="{{asset('plugins/nicescroll/nicescroll.min.js')}}"></script>
<script src="{{asset('plugins/currency/currency.min.js')}}"></script>
<script>
    function noty(msg,option = 1){
        if (window.innerWidth > 768) { // 768px es un ejemplo de punto de ruptura para responsive, ajústalo según tus necesidades
            Snackbar.show({
                text: msg.toUpperCase(),
                actionText: 'CERRAR',
                actionTextColor: option == 1 ? '#3b3f5c' : '#e7515a',
                backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
                customClass: 'snackbar-top-right'
            });
        }
    }
</script>

<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
@livewireScripts



