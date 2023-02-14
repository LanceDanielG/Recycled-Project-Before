<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php

    if(isset($_SESSION['success'])){
        echo "
            <script>
            toastr.success('". $_SESSION['success'] ."');
                toastr.options.timeOut = 3000;
            </script>
            
        ";
        unset($_SESSION['success']);
    }
    else if(isset($_SESSION['error'])){
        echo "
            <script>
                toastr.error('". $_SESSION['error'] ."');
                toastr.options.timeOut = 3000;
            </script>
                
        ";
        unset($_SESSION['error']);
    }
?>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
