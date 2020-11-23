<?php
$lastStatusAlisas=$order->status->pluck('alias')->last();
?>
<?php if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver')): ?>
<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
<script>
    function setSelectedOrderId(id){
        $("#form-assing-driver").attr("action", "updatestatus/assigned_to_driver/"+id);
    }
</script>
<td>
    <?php if($lastStatusAlisas == "just_created"): ?>
    <a href="<?php echo e('updatestatus/accepted_by_admin/'.$order->id); ?>" class="btn btn-success btn-sm order-action"><?php echo e(__('Accept')); ?></a>
    <a href="<?php echo e('updatestatus/rejected_by_admin/'.$order->id); ?>" class="btn btn-danger btn-sm order-action"><?php echo e(__('Reject')); ?></a>
    <?php elseif($lastStatusAlisas == "accepted_by_restaurant"&&$order->delivery_method.""!="2"): ?>
    <button type="button" class="btn btn-primary btn-sm order-action" onClick=(setSelectedOrderId(<?php echo e($order->id); ?>))  data-toggle="modal" data-target="#modal-asign-driver"><?php echo e(__('Assign to driver')); ?></a>
        <?php elseif($lastStatusAlisas == "prepared"&&$order->driver==null): ?>
        <button type="button" class="btn btn-primary btn-sm order-action" onClick=(setSelectedOrderId(<?php echo e($order->id); ?>))  data-toggle="modal" data-target="#modal-asign-driver"><?php echo e(__('Assign to driver')); ?></a>
            <?php else: ?>
            <small><?php echo e(__('No actions for you right now!')); ?></small>
            <?php endif; ?>
        </td>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('owner')): ?>
        <td>
            <?php if(!config('app.isqrsaas')): ?>
            <?php if($lastStatusAlisas == "accepted_by_admin"): ?>
            <a href="<?php echo e(url('updatestatus/accepted_by_restaurant/'.$order->id)); ?>" class="btn btn-success btn-sm order-action"><?php echo e(__('Accept')); ?></a>
            <a href="<?php echo e(url('updatestatus/rejected_by_restaurant/'.$order->id)); ?>" class="btn btn-danger btn-sm order-action"><?php echo e(__('Reject')); ?></a>
            <?php elseif($lastStatusAlisas == "assigned_to_driver"||$lastStatusAlisas == "accepted_by_restaurant"): ?>
            <a href="<?php echo e(url('updatestatus/prepared/'.$order->id)); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Prepared')); ?></a>
            <?php elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "accepted_by_restaurant"): ?>
            <a href="<?php echo e(url('updatestatus/prepared/'.$order->id)); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Prepared')); ?></a>
            <?php elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "prepared"): ?>
            <a href="<?php echo e(url('updatestatus/delivered/'.$order->id)); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
            <?php elseif($lastStatusAlisas == "prepared"&&$order->delivery_method.""=="2"): ?>
            <a href="<?php echo e(url('updatestatus/delivered/'.$order->id)); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
            <!--sushant 20-11-2020 -->
            <?php elseif($lastStatusAlisas == "closed"): ?>
            <?php if(isset($order->raitings->rating) && !empty($order->raitings->rating)): ?>
            <?php $__currentLoopData = $order->raitings->rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="fa fa-star" style="color: orange;"></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!--sushant 20-11-2020 -->
            <?php else: ?>
            <small><?php echo e(__('No actions for you right now!')); ?></small>
            <?php endif; ?>
            <?php else: ?>

            <?php if($lastStatusAlisas == "just_created"): ?>
            <a href="<?php echo e(url('updatestatus/accepted_by_restaurant/'.$order->id)); ?>" class="btn btn-success btn-sm order-action"><?php echo e(__('Accept')); ?></a>
            <a href="<?php echo e(url('updatestatus/rejected_by_restaurant/'.$order->id)); ?>" class="btn btn-sm btn-danger"><?php echo e(__('Reject')); ?></a>
            <?php elseif($lastStatusAlisas == "accepted_by_restaurant"): ?>
            <a href="<?php echo e(url('updatestatus/prepared/'.$order->id)); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Prepared')); ?></a>
            <?php elseif($lastStatusAlisas == "prepared"): ?>
            <a href="<?php echo e(url('updatestatus/delivered/'.$order->id)); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Delivered')); ?></a>
            <?php elseif($lastStatusAlisas == "delivered"): ?>
            <a href="<?php echo e(url('updatestatus/closed/'.$order->id)); ?>" class="btn btn-sm btn-danger"><?php echo e(__('Close')); ?></a>
            <?php elseif($lastStatusAlisas == "updated"): ?>
            <a href="<?php echo e(url('updatestatus/accepted_by_restaurant/'.$order->id)); ?>" class="btn btn-success btn-sm order-action"><?php echo e(__('Accept')); ?></a>
            <a href="<?php echo e(url('updatestatus/rejected_by_restaurant/'.$order->id)); ?>" class="btn btn-sm btn-danger"><?php echo e(__('Reject')); ?></a>
            <!--sushant 20-11-2020 -->
             <?php elseif($lastStatusAlisas == "closed"): ?>
            <?php if(isset($order->raitings->rating) && !empty($order->raitings->rating)): ?>
            <?php $__currentLoopData = $order->raitings->rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="fa fa-star" style="color: orange;"></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <!--sushant 20-11-2020 -->
            <?php else: ?>
            <small><?php echo e(__('No actions for you right now!')); ?></small>
            <?php endif; ?>
            <?php endif; ?>
        </td>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('driver')): ?>
        <td>
         <?php if($lastStatusAlisas == "prepared"): ?>
         <a href="<?php echo e('updatestatus/picked_up/'.$order->id); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Picked Up')); ?></a>
         <?php elseif($lastStatusAlisas == "picked_up"): ?>
         <a href="<?php echo e('updatestatus/delivered/'.$order->id); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
         <?php else: ?>
         <small><?php echo e(__('No actions for you right now!')); ?></small>
         <?php endif; ?>
     </td>
     <?php endif; ?>
     <?php endif; ?>
<?php /**PATH /var/www/html/qrcode/resources/views/orders/partials/actions/table.blade.php ENDPATH**/ ?>