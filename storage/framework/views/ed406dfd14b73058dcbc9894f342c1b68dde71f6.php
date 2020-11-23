<?php if(strlen(env('RECAPTCHA_SITE_KEY',""))>2): ?>
    <?php $__env->startSection('head'); ?>
    <?php echo htmlScriptTagJsApi([]); ?>

    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('users.partials.header', ['title' => __(''),], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--7">
        <div class="row">
            </div>
            <div class="col-xl-8 offset-xl-2">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0"><?php echo e($setup['title']); ?></h3>
                        </div>
                    </div>
                    <div class="card-body cu_card_b">
                        <form action="<?php echo e($setup['action']); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($setup['isupdate'])): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>
                            <?php if(isset($setup['inrow'])): ?>
                                <div class="row">
                            <?php endif; ?>
                                <?php echo $__env->make('partials.fields',['fields'=>$fields], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php if(isset($setup['inrow'])): ?>
                                </div>
                            <?php endif; ?>
                            <br />
                            <?php if(isset($setup['action_link'])): ?>
                                <a href="<?php echo e($setup['action_link']); ?>" class="btn btn-secondary"><?php echo e($setup['action_name']); ?></a>
                            <?php endif; ?>

                            <?php if(isset($setup['isupdate'])): ?>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>  
                            <?php else: ?>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Visit')); ?></button>  
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php if(isset($_GET['name'])&&$errors->isEmpty()): ?>
<script>
    "use strict";
    document.getElementById("thesubmitbtn").click(); 
</script> 
<?php endif; ?>
<script src="<?php echo e(asset('js')); ?>/bootstrap-input-spinner.js"></script>
<script>
    $("#duration").inputSpinner()
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', ['title' => __('User Profile')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/qrcode/resources/views/general/form_front.blade.php ENDPATH**/ ?>