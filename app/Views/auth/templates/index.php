
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>SI-RESTU</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/img/logo.png"/>

    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/custom/css/customUtilCss.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/vendor/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <!-- Navbar-->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">
                <!-- Navbar Brand -->
                <a href="#" class="navbar-brand">
                   <img src="<?= base_url(); ?>/img/logo.png" alt="logo" width="50"> 
                    SI-RESTU
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Sweetalert2 -->
    <script src="<?= base_url(); ?>/vendor/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/custom/js/customJs.js"></script>

    <!-- jquery-validation -->
    <script src="<?= base_url(); ?>/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/jquery-validation/additional-methods.min.js"></script>
    <script src="<?= base_url(); ?>/js/validate.js"></script>

    <script>
         if ('<?php echo session()->has('status');?>'){
            const message= '<?php echo session()->getFlashdata('message');?>';
            const status = '<?php echo session()->getFlashdata('status');?>';
            
            if(status == false || status==''){
                var toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
                });
                toast.fire({
                icon: 'warning',
                title: message,
                padding: '2em'
                });
            }else{
            var toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
                });
                toast.fire({
                icon: 'success',
                title: message,
                padding: '2em'
                });
            }
        }
    </script>

</body>
</html>

