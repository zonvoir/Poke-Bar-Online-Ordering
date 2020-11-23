<?php $__env->startSection('content'); ?>
<?php echo $__env->make('restorants.partials.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="section-profile-cover section-shaped grayscale-05 d-none d-md-none d-lg-block d-lx-block">
  <!-- Circles background -->
  <img class="bg-image" loading="lazy" src="<?php echo e($restorant->coverm); ?>" style="width: 100%;">
  <!-- SVG separator -->
  <div class="separator separator-bottom separator-skew">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</section>

<section class="section pt-lg-0 mb--5 mt--9 d-none d-md-none d-lg-block d-lx-block">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="title white"  <?php if($restorant->description || $openingTime && $closingTime){echo 'style="border-bottom: 1px solid #f2f2f2;"';} ?> >
          <h1 class="display-3 text-white" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;"><?php echo e($restorant->name); ?></h1>
          <p class="display-4" style="margin-top: 120px"><?php echo e($restorant->description); ?></p>
          <p><?php if(!empty($openingTime) && !empty($closingTime)): ?>  <i class="ni ni-watch-time"></i> <span><?php echo e($openingTime); ?></span> - <span><?php echo e($closingTime); ?></span> | <?php endif; ?>  <i class="ni ni-pin-3"></i></i> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode($restorant->address)); ?>"><?php echo e($restorant->address); ?></a>  |  <i class="ni ni-mobile-button"></i> <a href="tel:<?php echo e($restorant->phone); ?>"><?php echo e($restorant->phone); ?> </a></p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </div>

</section>
<section class="section section-lg d-md-block d-lg-none d-lx-none" style="padding-bottom: 0px">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="title">
          <h1 class="display-3 text" data-toggle="modal" data-target="#modal-restaurant-info" style="cursor: pointer;"><?php echo e($restorant->name); ?></h1>
          <p class="display-4 text"><?php echo e($restorant->description); ?></p>
          <?php if(!empty($openingTime) && !empty($closingTime)): ?>
          <p><?php echo e(__('Today working hours')); ?>: <span><strong><?php echo e($openingTime); ?></strong></span> - <span><strong><?php echo e($closingTime); ?></strong></span></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section pt-lg-0" id="restaurant-content" style="padding-top: 0px">
  <input type="hidden" id="rid" value="<?php echo e($restorant->id); ?>"/>
  <div class="container container-restorant">

    <?php if(!$restorant->categories->isEmpty()): ?>
    <nav class="tabbable sticky" style="top: <?php echo e(config('app.isqrsaas') ? 64:88); ?>px;">
      <ul class="nav nav-pills bg-white mb-2">
        <li class="nav-item nav-item-category ">
          <a class="nav-link  mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href=""><?php echo e(__('All categories')); ?></a>
        </li>
        <?php $__currentLoopData = $restorant->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$category->items->isEmpty()): ?>
        <li class="nav-item nav-item-category" id="<?php echo e('cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key))); ?>">
          <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" role="tab" id="<?php echo e('nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key))); ?>" href="#<?php echo e(clean(str_replace(' ', '', strtolower($category->name)).strval($key))); ?>"><?php echo e($category->name); ?></a>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </nav>
    <?php endif; ?>


    <?php if(!$restorant->categories->isEmpty()): ?>
    <?php $__currentLoopData = $restorant->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!$category->items->isEmpty()): ?>
    <div id="<?php echo e(clean(str_replace(' ', '', strtolower($category->name)).strval($key))); ?>" class="<?php echo e(clean(str_replace(' ', '', strtolower($category->name)).strval($key))); ?>">
      <h1><?php echo e($category->name); ?></h1><br />
    </div>
    <?php endif; ?>
    <div class="row <?php echo e(clean(str_replace(' ', '', strtolower($category->name)).strval($key))); ?>">
      <?php $__currentLoopData = $category->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($item->available == 1): ?>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="strip">
          <?php if(!empty($item->image)): ?>
          <figure>
            <a onClick="setCurrentItem(<?php echo e($item->id); ?>)" href="javascript:void(0)"><img src="<?php echo e($item->logom); ?>" loading="lazy" data-src="<?php echo e(config('global.restorant_details_image')); ?>" class="img-fluid lazy" alt=""></a>
          </figure>
          <?php endif; ?>
          <span class="res_title"><b><a onClick="setCurrentItem(<?php echo e($item->id); ?>)" href="javascript:void(0)"><?php echo e($item->name); ?></a></b></span><br />
          <span class="res_description"><?php echo e($item->short_description); ?></span><br />
          <span class="res_mimimum"><?php echo money($item->price, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)); ?></span>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <p class="text-muted mb-0"><?php echo e(__('Hmmm... Nothing found!')); ?></p>
        <br/><br/><br/>
        <div class="text-center" style="opacity: 0.2;">
          <img src="https://www.jing.fm/clipimg/full/256-2560623_juice-clipart-pizza-box-pizza-box.png" width="200" height="200"></img>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <i id="scrollTopBtn"  onclick="topFunction()" class="fa fa-arrow-up btn-danger"></i>

</section>
<!--checkin Modal -->
<div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="checkInModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable cust_sco" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkInModalTitle"><?php echo e(__('Check In')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="checkInModalForm">
          <div class="row">
            <input type="hidden" name="restaurant_id" value="<?php echo e($restorant->id); ?>">
            <div class="form-group col-md-6 ">
              <label class="form-control-label make_cl" for="">Time of entry</label>
              <input step=".01" type="text" name="" id="" class="form-control form-control-alternative   " placeholder="Time of entry" value="Wed, Nov 18, 2020 11:51 AM" required="" disabled="" autofocus="">
            </div> 

            <div class="form-group col-md-6 plus_minus">
             <label class="form-control-label make_cl" for="duration">Duration of visit(approximate)</label>
             <input data-suffix="Hour" min="1" max="8" type="number" name="duration" id="duration" class="form-control form-control-alternative"  value="1" required="" autofocus>
           </div>  
           <div class="form-group col-md-6 col-6 pr-0 o_cl com_c">
            <label class="form-control-label make_cl" for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-alternative   " placeholder="Name" value="" autofocus="">
          </div>   
          <div class="form-group col-md-6 col-6 pl-0 s_cl com_c">
            <label class="form-control-label invisible make_cl" for="sur_name">Surname</label>
            <input type="text" name="sur_name" id="sur_name" class="form-control form-control-alternative" placeholder="surname" value="" autofocus="">
          </div>                                
          <div class="form-group col-md-6 col-6 pr-0 t_cl com_c">
            <label class="form-control-label make_cl" for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control form-control-alternative" placeholder="Customer email" value="" autofocus="">
          </div> 
          <div class="form-group col-md-6 col-6 pl-0 f_cl com_c">
            <label class="form-control-label make_cl" for="phone_number">Phone</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control form-control-alternative   " placeholder="Customer phone" value="" autofocus="">
          </div> 

          <!-- <div class="form-group col-md-12 ">
            <label class="form-control-label make_cl">Table</label><br>
            <select class="form-control form-control-alternative" name="table_id" id="table_id">
              <option disabled="" selected="" value=""> Select Table </option>
              <?php if(isset($tables) && !empty($tables)): ?>
              <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </select>
          </div> -->

          <div class="form-group col-md-12 com_c">
            <label class="form-control-label make_cl " for="note">Note</label>
            <input type="text" name="note" id="note" class="form-control form-control-alternative   " placeholder="Custom note" value="" autofocus="">
          </div>                                
          <div class="form-group col-md-6 ">
            <input type="hidden" name="restaurant_id" id="restaurant_id" class="form-control form-control-alternative   " placeholder="Restaurant" value="1" required="" autofocus="">
          </div>                           
          <div class="form-group col-md-6 ">
            <input type="hidden" name="entry_time" id="entry_time" class="form-control form-control-alternative   " placeholder="Time of entry" value="Wed, Nov 18, 2020 11:51 AM" required="" autofocus="">
          </div>  
          <div class="col-md-12">
            <div class="custom-control custom-checkbox mb-3">
              <input class="custom-control-input" type="checkbox" name="declareCheck" value="" id="declareCheck">
              <label class="custom-control-label" for="declareCheck">
                I declare that the details above are accurate and correct.
              </label>
            </div> 
            <div class="custom-control custom-checkbox mb-3">
              <input class="custom-control-input" type="checkbox" name="illCheck" value="" id="illCheck">
              <label class="custom-control-label" for="illCheck">
                I am not currently experiencing any cold or flu-like symptoms.
              </label>
            </div>  
          </div>
          <div class="col-md-12">
           <p class="wr_dic_tec"><?php echo $restorant->checkin_disclaimers; ?></p>
           <div class="sub_btn">
             <button type="button" class="btn btn-secondary cancel_btn" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
             <button type="button" id="checkInModalBtn" class="btn btn-primary"><?php echo e(__('Check in')); ?></button>
           </div>
         </div>
       </div>
     </form>
   </div>
  <!-- <div class="modal-footer">
     
  </div> -->
</div>
</div>
</div>
<!-- checkin summery Modal -->
<div class="modal fade" id="checkInSummeryModal" tabindex="-1" role="dialog" aria-labelledby="checkInSummModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable cust_sco" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkInSummModalTitle"><?php echo e(__('Check In Summery')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="warp_summery_sec">
         <div class="summry__head">
          <h1 class="check_icon_png">
              <img src="<?php echo e(asset('images')); ?>/icons/check.png" class="img-responsive" alt="Image">
              You're checked in
             </h1>
          <p><?php echo $restorant->checkin_disclaimers; ?></p>
        </div>
        <div class="order_tabel_cl">
<!--          <h3>CHECK-IN SUMMARY</h3>-->
          <table class="table ">
            <tbody id="summ-tble-tbody">

            </tbody>
          </table>
        </div>
        <div class="btn_sumer_h">
            
          <a href="<?php echo e((isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS'] ?'https://':'http://').$_SERVER['HTTP_HOST'].'/restaurant/'.$restorant->subdomain); ?>" class="btn">View Menu</a>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="modal-footer">
     
  </div> -->
</div>
</div>
</div>
<!-- pick & dineIn  Modal -->
<div class="modal fade" id="pickDineModal" tabindex="-1" role="dialog" aria-labelledby="checkInSummModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable cust_sco" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkInSummModalTitle"><?php echo e(__('Pick or Dine')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body dine_pickup_body">
        <div class="warp_summery_sec">
         <div class="summry__head">
          <p></p>
        </div>
        <div class="pickdine_data">
         <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pick-up" role="tab" aria-controls="pills-home" aria-selected="true">Pick Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#table-service" role="tab" aria-controls="pills-profile" aria-selected="false">Table Service</a>
          </li>
        </ul>
        <hr>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pick-up" role="tabpanel" aria-labelledby="pills-home-tab"></div>
          <div class="tab-pane fade" id="table-service" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="form-group mb-0">
              <label for="usr">Table's:</label>
              <input type="text" class="form-control" id="">
            </div>
          </div>
        </div>
      </div>
      <div class="pick_dine_model_button">
        <button type="button" class="btn cancel_mode">Cancel</button>
        <button type="button" class="btn view_m">Confirm</button>
      </div>
    </div>
  </div>
</div>
  <!-- <div class="modal-footer">
     ssssss
   </div> -->
 </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
  "use strict";
  var items=[];
  var currentItem=null;
  var currentItemSelectedPrice=null;
  var lastAdded=null;
  var previouslySelected=[];
  var extrasSelected=[];
  var variantID=null;
  var CASHIER_CURRENCY = "<?php echo  env('CASHIER_CURRENCY','usd') ?>";
  var LOCALE="<?php echo  App::getLocale() ?>";

    /*
    * Price formater
    * @param  {Nummber} price
    */
    function formatPrice(price){
      var locale=LOCALE;
      if(CASHIER_CURRENCY.toUpperCase()=="USD"){
        locale=locale+"-US";
      }

      var formatter = new Intl.NumberFormat(locale, {
        style: 'currency',
        currency:  CASHIER_CURRENCY,
      });

      var formated=formatter.format(price);

      return formated;
    }

    /**
     * Load extras for variant
     * @param  {Number} variant_id the variant id
     * */
     function loadExtras(variant_id){
        //alert("Load extras for "+variant_id);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type:'GET',
          url: '/items/variants/'+variant_id+'/extras',
          success:function(response){
            if(response.status){
              response.data.forEach(element => {
                $('#exrtas-area-inside').append('<div class="custom-control custom-checkbox mb-3"><input onclick="recalculatePrice('+element.item_id+');" class="custom-control-input" id="'+element.id+'" name="extra"  value="'+element.price+'" type="checkbox"><label class="custom-control-label" for="'+element.id+'">'+element.name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+'+formatPrice(element.price)+'</label></div>');
              });
              $('#exrtas-area').show();

            }
          }, error: function (response) {
                    //return callback(false, response.responseJSON.errMsg);
                  }
                })
      }

    /**
     *
     * Set the selected variant, set price and shows qty area and calls load extras
     * */
     function setSelectedVariant(element){

        //console.log(formated);
        $('#modalPrice').html(formatPrice(element.price));

        //Set current item price
        currentItemSelectedPrice=element.price;

        //Show QTY
        $('.quantity-area').show();

        //Set variantID
        variantID=element.id;

        //Empty the extras, and call it
        $('#exrtas-area-inside').empty();
        loadExtras(variantID);

      }

      function getTheDataForTheFoundVariable(){
        console.log(previouslySelected);
        var comparableObject={};
        previouslySelected.forEach(element => {
          comparableObject[element.option_id]=element.name.trim().toLowerCase().replace(/\s/g , "-");
        });
        comparableObject=JSON.stringify(comparableObject)
        console.log("Comparable");
        console.log(comparableObject);
        currentItem['variants'].forEach(element => {
          console.log("Compare to");
          console.log(JSON.stringify(JSON.parse(element.options)));
          if(comparableObject==JSON.stringify(JSON.parse(element.options))){
            console.log("This are the options");
            console.log(element.options);
            console.log(element.optionsiconv);
            setSelectedVariant(element);
          }
        });

      }


      function checkIfVariableExists(forOption,optionValue){

        var newElement={"option_id":forOption,"name":optionValue};
        console.log('NEW ELEMNGT');
        console.log(newElement);

        var possibleSelection=JSON.parse(JSON.stringify(previouslySelected));
        possibleSelection.push(newElement);
        console.log(possibleSelection);

        var filteredObjects=[];
        //possibleSelection.forEach(element => {
          currentItem.variants.forEach(theVariant => {
            var theOptions=JSON.parse(theVariant.optionsiconv?theVariant.optionsiconv:theVariant.options);
            var ok=true;
            Object.keys(theOptions).map((key)=>{

              console.log(key+" : "+theOptions[key])
              possibleSelection.forEach(element => {
                if(key==element.option_id){
                  if(theOptions[key]+""!=element.name.trim().toLowerCase().replace(/\s/g , "-")+""){
                    ok=false;
                  }
                }
              });

            })

            if(ok){
              filteredObjects.push(theVariant);
              console.log("ok")
            }else{
              console.log("not ok")
            }

                //comparableObject[element.option_id]=element.name.trim().toLowerCase().replace(/\s/g , "-");
              });

        //});


        return filteredObjects.length>0;

      }

      function appendOption(name,id){
        lastAdded=id;
        $('#variants-area-inside').append('<div id="variants-area-'+id+'"><br /><label class="form-control-label"><b>'+name+'<b></label><div><div id="variants-area-inside-'+id+'" class="btn-group btn-group-toggle" data-toggle="buttons"> </div></div>');
      }

      function optionChanged(option_id,name){

        var newElement={"option_id":option_id,"name":name};
        //console.log("Lets search for");;
        //console.log(newElement);

        //If this option is already in the select, then it means it is old
        var tempObj=[];
        var wasOld=false;
        if(previouslySelected.length>0){
          previouslySelected.forEach(element => {
            if(!wasOld){
              if(element.option_id==option_id){
                        //This is old select, remove any new
                        tempObj.push(newElement);
                        wasOld=true;
                      }else{
                        tempObj.push(element);
                      }
                    }else{
                    //When rest, from the old one, remove the object
                    $( "#variants-area-"+element.option_id ).remove();
                  }

                });
        }

        if(wasOld){
          previouslySelected=tempObj;
            //alert(JSON.stringify(tempObj));
            //remove also last inserted, and readded it
            //$( "#variants-area-"+lastAdded ).remove();
          }else{
            previouslySelected.push(newElement);
          }
          setVariants();


        }

        function appendOptionValue(name,value,enabled,option_id){
          $('#variants-area-inside-'+option_id).append('<label style="opacity: '+(enabled?1:0.5)+'" class="btn btn-outline-primary"><input  onchange="optionChanged('+option_id+',\''+value+'\')"  '+ (enabled?"":"disabled") +' type="radio" name="option_'+option_id+'" value="option_'+option_id+"_"+name+'" autocomplete="off" />'+name+'</label>')
        }

        function setVariants(){
        //1. Determine previously selected variants
       // var previouslySelected=[];

       //HIDE QTY
       $('.quantity-area').hide();
       $('#exrtas-area-inside').empty();
       $('#exrtas-area').hide();

        //2. Get the new option to show
        var newOptionToShow=null;
        console.log(currentItem.options[previouslySelected.length]);
        newOptionToShow=currentItem.options[previouslySelected.length];

        if(newOptionToShow!=undefined){
            //2.1 Add the options in the table
            appendOption(newOptionToShow.name,newOptionToShow.id);


            var values=(newOptionToShow.optionsiconv?newOptionToShow.optionsiconv:newOptionToShow.options).split(",");
            var titles=(newOptionToShow.options).split(",");

            for (let index = 0; index < values.length; index++) {
              const theValue = values[index];
              const theTitle = titles[index];

              if(checkIfVariableExists(newOptionToShow.id,theValue)){
                    //Next variable exists
                    console.log("Exists: "+theValue);
                    appendOptionValue(theTitle,theValue,true,newOptionToShow.id);
                  }else{
                    //Vsaraiable with the next option value doens't exists
                    console.log("Does not exists: "+element);
                    appendOptionValue(theTitle,theValue,false,newOptionToShow.id);
                  }

                }

              }else{
                console.log("No more options");
                getTheDataForTheFoundVariable();
              }




        //3. Add the new option options
        //3.1 If new option is null, show the variant price
      }


      function setCurrentItem(id){


        var item=items[id];
        currentItem=item;
        previouslySelected=[];
        $('#modalTitle').text(item.name);
        $('#modalName').text(item.name);
        $('#modalPrice').html(item.price);
        $('#modalID').text(item.id);

        if(item.image != "/default/restaurant_large.jpg"){
          $("#modalImg").attr("src",item.image);
          $("#modalDialogItem").addClass("modal-lg");
          $("#modalImgPart").show();

          $("#modalItemDetailsPart").removeClass("col-sm-6 col-md-6 col-lg-6 offset-3");
          $("#modalItemDetailsPart").addClass("col-sm col-md col-lg");
        }else{
          $("#modalImgPart").hide();
          $("#modalItemDetailsPart").removeClass("col-sm col-md col-lg");
          $("#modalItemDetailsPart").addClass("col-sm-6 col-md-6 col-lg-6 offset-3");

          $("#modalDialogItem").removeClass("modal-lg");
          $("#modalDialogItem").addClass("col-sm-6 col-md-6 col-lg-6 offset-3");
        }

        $('#modalDescription').html(item.description);


        if(item.has_variants){
            //Vith variants
            //Hide the counter, and extrasts
            $('.quantity-area').hide();

           //Now show the variants options
           $('#variants-area-inside').empty();
           $('#variants-area').show();
           setVariants();
           //$('#modalPrice').html("dynamic");




         }else{
            //Normal
            currentItemSelectedPrice=item.priceNotFormated;
            $('#variants-area').hide();
            $('.quantity-area').show();
          }


          $('#productModal').modal('show');

          extrasSelected=[];

        //Now set the extrast
        if(item.extras.length==0||item.has_variants){
          console.log('has no extras');
          $('#exrtas-area-inside').empty();
          $('#exrtas-area').hide();
        }else{
          console.log('has extras');
          $('#exrtas-area-inside').empty();
          item.extras.forEach(element => {
            console.log(element);
            $('#exrtas-area-inside').append('<div class="custom-control custom-checkbox mb-3"><input onclick="recalculatePrice('+id+');" class="custom-control-input" id="'+element.id+'" name="extra"  value="'+element.price+'" type="checkbox"><label class="custom-control-label" for="'+element.id+'">'+element.name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+'+element.priceFormated+'</label></div>');
          });
          $('#exrtas-area').show();
        }
      }

      function recalculatePrice(id,value){
        //console.log("Triger price recalculation: "+id);
       // console.log(items[id]);
       var mainPrice=parseFloat(currentItemSelectedPrice);
       extrasSelected=[];

        //Get the selected check boxes
        $.each($("input[name='extra']:checked"), function(){
          mainPrice+=parseFloat(($(this).val()+""));
          extrasSelected.push($(this).attr('id'));
        });
        $('#modalPrice').html(formatPrice(mainPrice));

      }
      <?php

      function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
      }

      $items=[];
      $categories = [];
      foreach ($restorant->categories as $key => $category) {

        array_push($categories, clean(str_replace(' ', '', strtolower($category->name)).strval($key)));

        foreach ($category->items as $key => $item) {

          $formatedExtras=$item->extras;

          foreach ($formatedExtras as &$element) {
            $element->priceFormated=@money($element->price, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))."";
          }

            //Now add the variants and optins to the item data
          $itemOptions=$item->options;

          $theArray=array(
            'name'=>$item->name,
            'id'=>$item->id,
            'priceNotFormated'=>$item->price,
            'price'=>@money($item->price, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))."",
            'image'=>$item->logom,
            'extras'=>$formatedExtras,
            'options'=>$item->options,
            'variants'=>$item->variants,
            'has_variants'=>$item->has_variants==1&&$item->options->count()>0,
            'description'=>$item->description
          );
          echo "items[".$item->id."]=".json_encode($theArray).";";
        }
      }
      ?>
    </script>
    <script type="text/javascript">
      function getLocation(callback){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type:'GET',
          url: '/get/rlocation/'+$('#rid').val(),
          success:function(response){
            if(response.status){
              return callback(true, response.data)
            }
          }, error: function (response) {
            return callback(false, response.responseJSON.errMsg);
          }
        })
      }

      function initializeMap(lat, lng){
        var map_options = {
          zoom: 13,
          center: new google.maps.LatLng(lat, lng),
          mapTypeId: "terrain",
          scaleControl: true
        }

        map_location = new google.maps.Map( document.getElementById("map3"), map_options );
      }

      function initializeMarker(lat, lng){
        var markerData = new google.maps.LatLng(lat, lng);
        marker = new google.maps.Marker({
          position: markerData,
          map: map_location,
          icon: start
        });
      }

      var start = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Ball-Pink.png"
      var area = "https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/48/Map-Marker-Ball-Chartreuse.png"
      var map_location = null;
      var map_area = null;
      var marker = null;
      var infoWindow = null;
      var lat = null;
      var lng = null;
      var circle = null;
      var isClosed = false;
      var poly = null;
      var markers = [];
      var markerArea = null;
      var markerIndex = null;
      var path = null;

      var categories = <?php echo json_encode($categories); ?>;

      window.onload?window.onload():null;

      window.onload = function () {
            //var map, infoWindow, marker, lng, lat;

            getLocation(function(isFetched, currPost){
              if(isFetched){


                if(currPost.lat != 0 && currPost.lng != 0){
                        //initialize map
                        initializeMap(currPost.lat, currPost.lng)

                        //initialize marker
                        initializeMarker(currPost.lat, currPost.lng)

                        //var isClosed = false;
                      }
                    }
                  });
          }


          var mybutton = document.getElementById("scrollTopBtn");

          window.onscroll = function() {scrollFunction()};
          function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
              mybutton.style.display = "block";
            } else {
              mybutton.style.display = "none";
            }
          }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            //document.body.scrollTop = 0;
            $("html, body").animate({ scrollTop: 0 }, 600);
            document.documentElement.scrollTop = 0;
          }

          $(".nav-item-category").on('click', function() {
            $.each(categories, function( index, value ) {
              $("."+value).show();

                //$("#nav_"+value).removeClass("active");
              });

            var id = $(this).attr("id");
            var category_id = id.substr(id.indexOf("_")+1, id.length);
            //$("#nav_"+category_id).addClass("active");

            //$("."+category_id).hide();

            $.each(categories, function( index, value ) {
              if(value != category_id){
                $("."+value).hide();
              }
            });
          });
          var checkInType = "<?php echo e($restorant->checkin_type); ?>";
          $(document).ready(function(){
              let sessionActive = "<?php echo e(session('status')); ?>";
            if(checkInType == 'popup' && !sessionActive){
              $("#checkInModal").modal('show');
              /*$("#checkInSummeryModal").modal('show');*/
              /*$("#pickDineModal").modal('show');*/
            }
            $(document).ready(function() {
              $("#checkInModalBtn").click(function(e){
                $("#checkInModalForm").submit();
              });
              $("#checkInModalForm").validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                /*invalidHandler: function(event, validator) {
                  var errors = validator.numberOfInvalids(); // <- NUMBER OF INVALIDS
                  console.log(errors);
                },*/
                rules: {
                  name : "required",
                  sur_name : "required",
                  email: {
                    required: true,
                    email: true
                  },
                  phone_number: {
                    required: true,
                    minlength: 10
                  },
                  /*table_id: {
                    required: true
                  },*/
                  note: {
                    required: true
                  },
                  declareCheck: {
                    required: true
                  },
                  illCheck: {
                    required: true
                  },
                },
                messages: {
                  name: "",
                  sur_name: "",
                  email: "",
                  phone_number:"",
                  /*table_id:"",*/
                  note:"",
                  declareCheck:"",
                  illCheck:""
                },
                showErrors: function(errorMap, errorList) {
                  var errors = this.numberOfInvalids(); // <- NUMBER OF INVALIDS
                  $("#num_invalids").html(errors);
                    //console.log(errorMap);
                    $.each(errorMap, function(key, value) {
                    // console.log(key);
                    var parent = $('[name="' + key + '"]').parent();
                    $(parent).removeClass('has-success');
                    parent.addClass('has-danger');
                    //console.log(parent);
                  });
                  //this.defaultShowErrors(); // <- ENABLE default MESSAGES
                },
                onkeyup: function(element, event){
                  if($(element).val() != ''){
                    $(element).addClass('is-valid');
                    $(element).parent().removeClass('has-danger');
                    $(element).parent().addClass('has-success');
                  }else{
                   $(element).addClass('is-invalid');
                   $(element).parent().addClass('has-danger');
                   $(element).parent().removeClass('has-success');
                 }
               },
               onclick: function(element, event){
                if ($(element).prop("checked")){
                  $(element).addClass('is-valid');
                  $(element).parent().removeClass('has-danger');
                  $(element).parent().addClass('has-success');
                }else{
                  $(element).addClass('is-invalid');
                  $(element).parent().addClass('has-danger');
                  $(element).parent().removeClass('has-success');
                }
              },
              submitHandler: function(form) {
                var formData = $("#checkInModalForm").serialize();
                var tableData = '';
                $.post("<?php echo e(route('register.visit.storeAjax')); ?>",formData, function(data, status){
                  if(status == 'success'){
                    tableData +='<tr><th>Time of entry</th><td>'+data.data.entry_time+'</td></tr>';
                    tableData +='<tr><th>Duration of Visit</th><td>'+data.data.duration+' hours</td></tr>';
                    tableData +='<tr><th>Name</th><td>'+data.data.name+'</td></tr>';
                    tableData +='<tr><th>Contact phone Number</th><td>'+data.data.phone_number+'</td></tr>';
                    tableData +='<tr><th>Email Address</th><td>'+data.data.email+'</td></tr>';
                    $("#summ-tble-tbody").html(tableData);
                    $("#checkInModal").modal('hide');
                    $("#checkInSummeryModal").modal('show');
                  }
                },'json');
              }
            })
})
})
</script>
<script src="<?php echo e(asset('js')); ?>/bootstrap-input-spinner.js"></script>
<script>
  $("#duration").inputSpinner()
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front', ['class' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/qrcode/resources/views/restorants/show.blade.php ENDPATH**/ ?>