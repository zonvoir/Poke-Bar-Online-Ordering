<div class="form-group<?php echo e($errors->has($id) ? ' has-danger' : ''); ?>  <?php if(isset($class)): ?> <?php echo e($class); ?> <?php endif; ?>">
   <?php if(!(isset($type)&&$type=="hidden")): ?>
   <label class="form-control-label <?php echo e(isset($lableVsisibility) && $lableVsisibility == 'invisible' ? $lableVsisibility : ''); ?>" for="<?php echo e($id); ?>"><?php echo e(__($name)); ?><?php if(isset($link)): ?><a target="_blank" href="<?php echo e($link); ?>"><?php echo e($linkName); ?></a><?php endif; ?></label>
   <?php endif; ?>
   <input <?php if(isset($accept)): ?> accept="<?php echo e($accept); ?>" <?php endif; ?> step=".01" type="<?php echo e(isset($type)?$type:"text"); ?>" name="<?php echo e($id); ?>" id="<?php echo e($id); ?>" class="form-control form-control-alternative <?php if(isset($editclass)): ?> <?php echo e($editclass); ?> <?php endif; ?>  <?php echo e($errors->has($id) ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__($placeholder)); ?>" value="<?php echo e(old($id)?old($id):(isset($value)?$value:(app('request')->input($id)?app('request')->input($id):null))); ?>" <?php if($required) {echo 'required';} ?> <?php if(isset($disabled) && $disabled) {echo 'disabled';} ?> autofocus>
   <?php if(isset($additionalInfo)): ?>
   <small class="text-muted"><strong><?php echo e(__($additionalInfo)); ?></strong></small>
   <?php endif; ?>
   <?php if($errors->has($id)): ?>
   <span class="invalid-feedback" role="alert">
    <strong><?php echo e($errors->first($id)); ?></strong>
</span>
<?php endif; ?>
</div><?php /**PATH /var/www/html/qrcode/resources/views/partials/input.blade.php ENDPATH**/ ?>