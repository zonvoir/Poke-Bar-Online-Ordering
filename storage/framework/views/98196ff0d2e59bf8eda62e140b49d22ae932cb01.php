<?php if(session('status')): ?>
    <div class="alert_massge_cus alert alert-success alert-dismissible fade show" role="alert">
        <img src="<?php echo e(asset('images')); ?>/icons/white_bg_check.png" class="img-responsive" alt="Image">
        <?php echo e(session('status')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert_massge_cus alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('error')); ?>

         <img src="<?php echo e(asset('images')); ?>/icons/close.png" class="img-responsive" alt="Image">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?><?php /**PATH /var/www/html/qrcode/resources/views/partials/flash.blade.php ENDPATH**/ ?>