<div class="form-group <?php echo e($errors->has($id) ? ' has-danger' : ''); ?>  <?php if(isset($class)): ?> <?php echo e($class); ?> <?php endif; ?>">

    <label class="form-control-label"><?php echo e(__($name)); ?></label><br />

    <select class="form-control form-control-alternative"  name="<?php echo e($id); ?>" id="<?php echo e($id); ?>">
        <option selected value> <?php echo e(__('Select')." ".__($name)); ?> </option>
        <?php if(isset($data) && !empty($data)): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(old($id)&&old($id).""==$key.""): ?>
                <option  selected value="<?php echo e($key); ?>"><?php echo e(__($item)); ?></option>
            <?php elseif(isset($value)&&strtoupper($value."")==strtoupper($key."")): ?>
                <option  selected value="<?php echo e($key); ?>"><?php echo e(__($item)); ?></option>
            <?php elseif(app('request')->input($id)&&strtoupper(app('request')->input($id)."")==strtoupper($key."")): ?>
                <option  selected value="<?php echo e($key); ?>"><?php echo e(__($item)); ?></option>
            <?php else: ?>
                <option value="<?php echo e($key); ?>"><?php echo e(__($item)); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>


    <?php if(isset($additionalInfo)): ?>
        <small class="text-muted"><strong><?php echo e(__($additionalInfo)); ?></strong></small>
    <?php endif; ?>
    <?php if($errors->has($id)): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first($id)); ?></strong>
        </span>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/qrcode/resources/views/partials/select.blade.php ENDPATH**/ ?>