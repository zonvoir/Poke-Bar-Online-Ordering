<nav id="navbar-main" class="navbar navbar-light navbar-expand-lg fixed-top">
     

    <div class="container-fluid">
        <?php if(!env('HIDE_PROJECT_BRANDING',true)): ?>
          <a class="navbar-brand mr-lg-5" href="/">
            <img src="<?php echo e(config('global.site_logo')); ?>">
          </a>
        <?php endif; ?>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <?php if(!env('HIDE_PROJECT_BRANDING',true)): ?>
              <div class="col-6 collapse-brand">
                <a href="#">
                  <img src="<?php echo e(config('global.site_logo')); ?>">
                </a>
              </div>
              <?php endif; ?>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            

              <?php if(\Request::route()->getName() == "vendor"): ?>
                <?php if(config('app.isqrsaas')): ?>
                  <?php if(env('ENABLE_GUEST_LOG',true)): ?>
                  <li class="web-menu mr-1">
                    <a  href="<?php echo e(route('register.visit',['restaurant_id'=>$restorant->id])); ?>" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                          <span class="btn-inner--icon">
                            <i class="fa fa-calendar-plus-o"></i>
                          </span>
                          <span class="nav-link-inner--text"><?php echo e(__('Register visit')); ?></span>
                      </a>
                  </li>
                  <?php endif; ?>
                  <?php if(isset($hasGuestOrders)&&$hasGuestOrders): ?>
                  <li class="web-menu mr-1">
                    <a  href="<?php echo e(route('guest.orders')); ?>" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                      <span class="btn-inner--icon">
                        <i class="fa fa-list-alt"></i>
                      </span>
                      <span class="nav-link-inner--text"><?php echo e(__('My Orders')); ?></span>
                    </a>
                  </li>
                  <?php endif; ?>
                <?php endif; ?>

              <?php endif; ?>

            
            <li class="web-menu">

              <?php if(\Request::route()->getName() != "cart.checkout"): ?>
                <a  id="desCartLink" onclick="openNav()" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                  <span class="btn-inner--icon">
                    <i class="fa fa-shopping-cart"></i>
                  </span>
                  <span class="nav-link-inner--text"><?php echo e(__('Cart')); ?></span>
              </a>
              <?php endif; ?>

            </li>
            <li class="mobile-menu">
              <?php if(\Request::route()->getName() == "vendor"): ?>
                <?php if(config('app.isqrsaas')): ?>
                  <?php if(env('ENABLE_GUEST_LOG',true)): ?>
                    <a href="<?php echo e(route('register.visit',['restaurant_id'=>$restorant->id])); ?>" class="nav-link" style="cursor:pointer;">
                        <i class="fa fa-calendar-plus-o"></i>
                        <span class="nav-link-inner--text"><?php echo e(__('Register visit')); ?></span>
                    </a>
                  <?php endif; ?>
                  <?php if(isset($hasGuestOrders)&&$hasGuestOrders): ?>
                  
                    <a  href="<?php echo e(route('guest.orders')); ?>" class="nav-link" style="cursor:pointer;">
                     
                        <i class="fa fa-list-alt"></i>
                      
                      <span class="nav-link-inner--text"><?php echo e(__('My Orders')); ?></span>
                    </a>
                  <?php endif; ?>
                <?php endif; ?>
                <a  id="mobileCartLink" onclick="openNav()" class="nav-link" style="cursor:pointer;">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-link-inner--text"><?php echo e(__('Cart')); ?></span>
                </a>
              <?php endif; ?>


            </li>
          </ul>
        </div>


      </div>
     
    </nav>
  <?php /**PATH /var/www/html/qrcode/resources/views/layouts/menu/top_justlogo.blade.php ENDPATH**/ ?>