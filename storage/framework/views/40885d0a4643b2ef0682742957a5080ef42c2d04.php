<!--
=========================================================
* Argon Design System - v1.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (http://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('argonfront')); ?>/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo e(asset('argonfront')); ?>/img/favicon.png">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta property="og:image" content="<?php echo e(config('global.site_logo')); ?>">
    <title><?php echo e(config('global.site_name','FoodTiger')); ?></title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="<?php echo e(asset('argonfront')); ?>/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo e(asset('argonfront')); ?>/css/nucleo-svg.css" rel="stylesheet" />
    <link href="<?php echo e(asset('argonfront')); ?>/css/nucleo-icons.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="<?php echo e(asset('argonfront')); ?>/css/argon-design-system.min.css?v=1.4.0" rel="stylesheet" />

    <!-- Custom CSS -->
    <link type="text/css" href="<?php echo e(asset('custom')); ?>/css/custom.css" rel="stylesheet">

    <!-- Select2 -->
    <link type="text/css" href="<?php echo e(asset('custom')); ?>/css/select2.min.css" rel="stylesheet">



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php if(env('GOOGLE_ANALYTICS',false)): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo env('GOOGLE_ANALYTICS',''); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo env('GOOGLE_ANALYTICS',''); ?>');
        </script>
    <?php endif; ?>
   
  <?php echo $__env->make('googletagmanager::head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('head'); ?>
  <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- Custom CSS defined by admin -->
<link type="text/css" href="<?php echo e(asset('byadmin')); ?>/front.css" rel="stylesheet">

</head>

<body class="">
    <?php echo $__env->make('googletagmanager::body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(auth()->guard()->check()): ?>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    <?php endif; ?>



    <!-- Navbar -->
    <?php if(!config('app.isqrsaas')): ?>
        <?php echo $__env->make('layouts.menu.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('layouts.menu.top_justlogo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    
    <!-- End Navbar -->
    <div class="wrapper">
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('layouts.navbars.cartSideMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.footers.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(request()->get('location') ): ?>
            <?php echo $__env->make('layouts.headers.modallocation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <!--   Core JS Files   -->
    <script src="<?php echo e(asset('argonfront')); ?>/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('argonfront')); ?>/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('argonfront')); ?>/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('argonfront')); ?>/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo e(asset('argonfront')); ?>/js/plugins/bootstrap-switch.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?php echo e(asset('argonfront')); ?>/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('argonfront')); ?>/js/plugins/moment.min.js"></script>

    <script src="<?php echo e(asset('argonfront')); ?>/js/plugins/datetimepicker.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('argonfront')); ?>/js/plugins/bootstrap-datepicker.min.js"></script>

    <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo e(asset('argonfront')); ?>/js/argon-design-system.js?v=1.2.0" type="text/javascript"></script>


   <!-- Import Vue -->
   <script src="<?php echo e(asset('vendor')); ?>/vue/vue.js"></script>
   <!-- Import AXIOS --->
   <script src="<?php echo e(asset('vendor')); ?>/axios/axios.min.js"></script>

    <!-- Add to Cart   -->
    <script>
        var LOCALE="<?php echo  App::getLocale() ?>";
        var CASHIER_CURRENCY = "<?php echo  env('CASHIER_CURRENCY','usd') ?>";
    </script>
    <script src="<?php echo e(asset('custom')); ?>/js/cartFunctions.js"></script>
    

    <!-- Cart custom sidemenu -->
    <script src="<?php echo e(asset('custom')); ?>/js/cartSideMenu.js"></script>

    <!-- Notify JS -->
    <script src="<?php echo e(asset('custom')); ?>/js/notify.min.js"></script>

     <!-- SELECT2 -->
     <script src="<?php echo e(asset('custom')); ?>/js/select2.js"></script>
     <script src="<?php echo e(asset('vendor')); ?>/select2/select2.min.js"></script>

     <!-- Google Map -->
     <script async defer
            src= "https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=<?php echo env('GOOGLE_MAPS_API_KEY',''); ?>">
    </script>

    <?php echo $__env->yieldContent('js'); ?>

    <!-- Custom JS defined by admin -->
    <?php echo file_get_contents(base_path('public/byadmin/front.js')) ?>

</body>

</html>
<?php /**PATH /var/www/html/qrcode/resources/views/layouts/front.blade.php ENDPATH**/ ?>