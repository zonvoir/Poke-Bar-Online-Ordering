<?php $__env->startSection('admin_title'); ?>
<?php echo e(__('Restaurant Management')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-6">
            <br/>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0"><?php echo e(__('Restaurant Management')); ?></h3>
                            <?php if(env('WILDCARD_DOMAIN_READY',false)): ?>
                            <span class="blockquote-footer"><?php echo e((isset($_SERVER['HTTPS'])&&$_SERVER["HTTPS"] ?"https://":"http://").$restorant->subdomain.".".$_SERVER['HTTP_HOST']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-4 text-right">
                            <?php if(auth()->user()->hasRole('admin')): ?>
                            <a href="<?php echo e(route('admin.restaurants.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back to list')); ?></a>
                            <?php endif; ?>

                            <?php if(env('WILDCARD_DOMAIN_READY',false)): ?>
                            <a target="_blank" href="<?php echo e((isset($_SERVER['HTTPS'])&&$_SERVER["HTTPS"] ?"https://":"http://").$restorant->subdomain.".".$_SERVER['HTTP_HOST']); ?>" class="btn btn-sm btn-success"><?php echo e(__('View it')); ?></a>
                            <?php else: ?>
                            <a target="_blank" href="<?php echo e(route('vendor',$restorant->subdomain)); ?>" class="btn btn-sm btn-success"><?php echo e(__('View it')); ?></a>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
                <div class="card-body">
                 <h6 class="heading-small text-muted mb-4"><?php echo e(__('Restaurant information')); ?></h6>
                 <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <div class="pl-lg-4">
                    <form method="post" action="<?php echo e(route('admin.restaurants.update', $restorant)); ?>" autocomplete="off" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <input type="hidden" id="rid" value="<?php echo e($restorant->id); ?>"/>
                        <?php echo $__env->make('partials.fields',['fields'=>[
                        ['ftype'=>'input','name'=>"Restaurant Name",'id'=>"name",'placeholder'=>"Restaurant Name",'required'=>true,'value'=>$restorant->name],
                        ['ftype'=>'input','name'=>"Restaurant Description",'id'=>"description",'placeholder'=>"Restaurant description",'required'=>true,'value'=>$restorant->description],
                        ['ftype'=>'input','name'=>"Restaurant Address",'id'=>"address",'placeholder'=>"Restaurant description",'required'=>true,'value'=>$restorant->address],
                        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php if(env('MULTI_CITY',false)): ?>
                        <?php echo $__env->make('partials.fields',['fields'=>[
                        ['ftype'=>'select','name'=>"Restaurant city",'id'=>"city_id",'data'=>$cities,'required'=>true,'value'=>$restorant->city_id],

                        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>



                        <div class="form-group<?php echo e($errors->has('minimum') ? ' has-danger' : ''); ?>">
                            <label class="form-control-label" for="input-description"><?php echo e(__('Minimum order')); ?></label>
                            <input type="number" name="minimum" id="input-minimum" class="form-control form-control-alternative<?php echo e($errors->has('minimum') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Enter Minimum order value')); ?>" value="<?php echo e(old('minimum', $restorant->minimum)); ?>" required autofocus>
                            <?php if($errors->has('minimum')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('minimum')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php if(auth()->user()->hasRole('admin')): ?>
                        <br/>
                        <div class="row">
                            <div class="col-6 form-group<?php echo e($errors->has('fee') ? ' has-danger' : ''); ?>">
                                <label class="form-control-label" for="input-description"><?php echo e(__('Fee percent')); ?></label>
                                <input type="number" name="fee" id="input-fee" step="any" min="0" max="100" class="form-control form-control-alternative<?php echo e($errors->has('fee') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('fee', $restorant->fee)); ?>" required autofocus>
                                <?php if($errors->has('fee')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('fee')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-6 form-group<?php echo e($errors->has('static_fee') ? ' has-danger' : ''); ?>">
                                <label class="form-control-label" for="input-description"><?php echo e(__('Static fee')); ?></label>
                                <input type="number" name="static_fee" id="input-fee" step="any" min="0" max="100" class="form-control form-control-alternative<?php echo e($errors->has('static_fee') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('static_fee', $restorant->static_fee)); ?>" required autofocus>
                                <?php if($errors->has('static_fee')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('static_fee')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="form-control-label" for="item_price"><?php echo e(__('Is Featured')); ?></label>
                            <label class="custom-toggle" style="float: right">
                                <input type="checkbox" name="is_featured" <?php if($restorant->is_featured == 1){echo "checked";}?>>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        <br/>
                        <?php endif; ?>

                        <div class="row">
                            <?php
                            $images=[
                                ['name'=>'resto_logo','label'=>__('Restaurant Image'),'value'=>$restorant->logom,'style'=>'width: 295px; height: 200px;'],
                                ['name'=>'resto_cover','label'=>__('Restaurant Cover Image'),'value'=>$restorant->coverm,'style'=>'width: 200px; height: 100px;']
                            ]
                            ?>
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <?php echo $__env->make('partials.images',$image, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                        </div>
                    </form>
                </div>
                <hr />
                <h6 class="heading-small text-muted mb-4"><?php echo e(__('Owner information')); ?></h6>
                <div class="pl-lg-4">
                    <div class="form-group<?php echo e($errors->has('name_owner') ? ' has-danger' : ''); ?>">
                        <label class="form-control-label" for="name_owner"><?php echo e(__('Owner Name')); ?></label>
                        <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative" placeholder="<?php echo e(__('Owner Name')); ?>" value="<?php echo e(old('name', $restorant->user->name)); ?>" readonly>
                    </div>
                    <div class="form-group<?php echo e($errors->has('email_owner') ? ' has-danger' : ''); ?>">
                        <label class="form-control-label" for="email_owner"><?php echo e(__('Owner Email')); ?></label>
                        <input type="text" name="email_owner" id="email_owner" class="form-control form-control-alternative" placeholder="<?php echo e(__('Owner Email')); ?>" value="<?php echo e(old('name', $restorant->user->email)); ?>" readonly>
                    </div>
                    <div class="form-group<?php echo e($errors->has('phone_owner') ? ' has-danger' : ''); ?>">
                        <label class="form-control-label" for="phone_owner"><?php echo e(__('Owner Phone')); ?></label>
                        <input type="text" name="phone_owner" id="phone_owner" class="form-control form-control-alternative" placeholder="<?php echo e(__('Owner Phone')); ?>" value="<?php echo e(old('name', $restorant->user->phone)); ?>" readonly>
                    </div>
                </div>
                <h6 class="heading-small text-muted mb-4"><?php echo e(__('Settings')); ?></h6>
                <form method="post" action="<?php echo e(route('restaurant.setting')); ?>" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="rid" name="rid" value="<?php echo e($restorant->id); ?>"/>
                    <div class="pl-lg-4">
                        <div class="form-group<?php echo e($errors->has('checkin_type') ? ' has-danger' : ''); ?>">
                            <label class="form-control-label" for="checkInPopup"><?php echo e(__('Check in type')); ?></label>
                            <div class="custom-control form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" name="checkin_type" id="checkInPopup" value="popup" <?php echo e($restorant->checkin_type == 'popup' ? 'checked' : ''); ?>>
                              <label class="form-check-label" for="checkInPopup"><?php echo e(__('Popup')); ?></label>
                          </div>
                      </div>
                      <div class="form-group<?php echo e($errors->has('allow_pickup') ? ' has-danger' : ''); ?>">
                        <label class="form-control-label" for="allow_pickup"><?php echo e(__('Pickup allowed ?')); ?></label>
                        <select class="form-control form-control-alternative" id="allow_pickup" name="allow_pickup">
                            <option value="YES" <?php echo e($restorant->allow_pickup == 'YES' ? 'selected' : ''); ?>>Yes</option>
                            <option value="NO" <?php echo e($restorant->allow_pickup == 'NO' ? 'selected' : ''); ?>>No</option>
                        </select>
                    </div>
                      <div class="form-group<?php echo e($errors->has('checkin_disclaimers') ? ' has-danger' : ''); ?>">
                        <label class="form-control-label" for="checkin_disclaimers"><?php echo e(__('Check in disclaimers')); ?></label>
                        <textarea class="form-control form-control-alternative ckeditor" id="checkin_disclaimers" name="checkin_disclaimers"><?php echo e(old('checkin_disclaimers', $restorant->checkin_disclaimers)); ?></textarea>
                    </div>
                    <div class="form-group<?php echo e($errors->has('checkin_summery_disclaimers') ? ' has-danger' : ''); ?>">
                        <label class="form-control-label" for="checkin_summery_disclaimers"><?php echo e(__('Check in summery disclaimers')); ?></label>
                        <textarea class="form-control form-control-alternative ckeditor" id="checkin_summery_disclaimers" name="checkin_summery_disclaimers"><?php echo e(old('checkin_summery_disclaimers', $restorant->checkin_summery_disclaimers)); ?></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-xl-6 mb-5 mb-xl-0">
    <br/>
    <div class="card card-profile shadow">
        <div class="card-header">
            <h5 class="h3 mb-0"><?php echo e(__("Restaurant Location")); ?></h5>
        </div>
        <div class="card-body">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(__('Location')); ?></a>
                    </li>
                    <?php if(!config('app.isqrsaas')): ?>
                    <?php if(!env('DISABLE_DELIVER',false)): ?>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Delivery Area')); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div id="map_location" class="form-control form-control-alternative"></div>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div id="map_area" class="form-control form-control-alternative"></div>
                            <br/>
                            <button type="button" id="clear_area" class="btn btn-danger btn-sm btn-block"><?php echo e(__("Clear Delivery Area")); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="card card-profile bg-secondary shadow">
        <div class="card-header">
            <h5 class="h3 mb-0"><?php echo e(__("Working Hours")); ?></h5>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo e(route('restaurant.workinghours')); ?>" autocomplete="off" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="rid" name="rid" value="<?php echo e($restorant->id); ?>"/>
                <div class="form-group">
                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <br/>
                    <div class="row">
                        <div class="col-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="days" class="custom-control-input" id="<?php echo e('day'.$key); ?>" value=<?php echo e($key); ?>>
                                <label class="custom-control-label" for="<?php echo e('day'.$key); ?>"><?php echo e(__($value)); ?></label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                </div>
                                <input id="<?php echo e($key.'_from'); ?>" name="<?php echo e($key.'_from'); ?>" class="flatpickr datetimepicker form-control" type="text" placeholder="<?php echo e(__('Time')); ?>">
                            </div>
                        </div>
                        <div class="col-2 text-center">
                            <p class="display-4">-</p>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                                </div>
                                <input id="<?php echo e($key.'_to'); ?>" name="<?php echo e($key.'_to'); ?>" class="flatpickr datetimepicker form-control" type="text" placeholder="<?php echo e(__('Time')); ?>">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <?php if(auth()->user()->hasRole('admin')&&config('app.isqrsaas')): ?>
    <br />
    <div class="card card-profile bg-secondary shadow">
        <div class="card-header">
            <h5 class="h3 mb-0"><?php echo e(__("Subscription plan")); ?></h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('update.plan')); ?>" >
                <?php echo csrf_field(); ?>
                <input type="hidden" name="user_id" value="<?php echo e($restorant->user->id); ?>">
                <input type="hidden" name="restaurant_id" value="<?php echo e($restorant->id); ?>">

                <?php echo $__env->make('partials.fields',['fields'=>[
                ['ftype'=>'select','name'=>"Current plan",'id'=>"plan_id",'data'=>$plans,'required'=>true,'value'=>$restorant->user->mplanid()],

                ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                </div>  

            </form>
        </div>
    </div>
    <?php endif; ?>
</div>
</div>
<?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Google Map -->
<script async defer src= "https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=<?php echo env('GOOGLE_MAPS_API_KEY',''); ?>"> </script>
<script type="text/javascript" src="<?php echo e(asset('ckeditor')); ?>/ckeditor.js"></script>

<script type="text/javascript">
    "use strict";
    var defaultHourFrom = "09:00";
    var defaultHourTo = "17:00";

    var timeFormat = '<?php echo e(env('TIME_FORMAT','24hours')); ?>';

    function formatAMPM(date) {
            //var hours = date.getHours();
            //var minutes = date.getMinutes();
            var hours = date.split(':')[0];
            var minutes = date.split(':')[1];

            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            //minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

        //console.log(formatAMPM("19:05"));

        var config = {
            enableTime: true,
            dateFormat: timeFormat == "AM/PM" ? "h:i K": "H:i",
            noCalendar: true,
            altFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
            altInput: true,
            allowInput: true,
            time_24hr: timeFormat == "AM/PM" ? false : true,
            onChange: [
            function(selectedDates, dateStr, instance){
                    //...
                    this._selDateStr = dateStr;
                },
                ],
                onClose: [
                function(selDates, dateStr, instance){
                    if (this.config.allowInput && this._input.value && this._input.value !== this._selDateStr) {
                        this.setDate(this.altInput.value, false);
                    }
                }
                ]
            };

            $("input[type='checkbox'][name='days']").change(function() {


                var hourFrom = flatpickr($('#'+ this.value + '_from'), config);
                var hourTo = flatpickr($('#'+ this.value + '_to'), config);

                if(this.checked){
                    hourFrom.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourFrom) : defaultHourFrom, false);
                    hourTo.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourTo) : defaultHourTo, false);
                }else{
                    hourFrom.clear();
                    hourTo.clear();
                }
            });

            $('input:radio[name="primer"]').change(function(){
                if($(this).val() == 'map') {
                    $("#clear_area").hide();
                }else if($(this).val() == 'area' && isClosed){
                    $("#clear_area").show();
                }
            });

            $("#clear_area").on("click",function() {
            //remove markers
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }

            //remove polygon
            poly.setMap(null);
            poly.setPath([]);

            poly = new google.maps.Polyline({ map: map_area, path: [], strokeColor: "#FF0000", strokeOpacity: 1.0, strokeWeight: 2 });

            path = poly.getPath();

            //update delivery path
            changeDeliveryArea(path)

            isClosed = false;
            $("#clear_area").hide();
        });

        //Initialize working hours
        function initializeWorkingHours(){
            var workingHours = <?php echo json_encode($hours); ?>;
            if(workingHours != null){
                Object.keys(workingHours).map((key, index)=>{
                    if(workingHours[key] != null){
                        var hour = flatpickr($('#'+key), config);
                        hour.setDate(workingHours[key], false);

                        var day_key = key.split('_')[0];
                        $('#day'+day_key).attr('checked', 'checked');
                    }
                })
            }
        }

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

        function changeLocation(lat, lng){
            //var latConv = parseFloat(lat.toString().substr(0, 5));
            //var lngConv = parseFloat(lng.toString().substr(0, 5));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: '/updateres/location/'+$('#rid').val(),
                dataType: 'json',
                data: {
                    lat: lat,
                    lng: lng
                },
                success:function(response){
                    if(response.status){
                        console.log(response.status)
                    }
                }, error: function (response) {
                //alert(response.responseJSON.errMsg);
            }
        })
        }

        function changeDeliveryArea(path){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: '/updateres/delivery/'+$('#rid').val(),
                dataType: 'json',
                data: {
                    path: JSON.stringify(path.i)
                },
                success:function(response){
                    if(response.status){
                        console.log(response.status)
                    }
                }, error: function (response) {
                //alert(response.responseJSON.errMsg);
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

            map_location = new google.maps.Map( document.getElementById("map_location"), map_options );
            map_area = new google.maps.Map( document.getElementById("map_area"), map_options );
        }

        function initializeMarker(lat, lng){
            var markerData = new google.maps.LatLng(lat, lng);
            marker = new google.maps.Marker({
                position: markerData,
                map: map_location,
                icon: start
            });
        }

        function new_delivery_area(latLng){
            if (isClosed) return;
            markerIndex = poly.getPath().length;
            var isFirstMarker = markerIndex === 0;
            markerArea = new google.maps.Marker({ map: map_area, position: latLng, draggable: false, icon: area });

            //push markers
            markers.push(markerArea);

            if(isFirstMarker) {
                google.maps.event.addListener(markerArea, 'click', function () {
                    if (isClosed) return;
                    path = poly.getPath();
                    poly.setMap(null);
                    poly = new google.maps.Polygon({ map: map_area, path: path, strokeColor: "#FF0000", strokeOpacity: 0.8, strokeWeight: 2, fillColor: "#FF0000", fillOpacity: 0.35, editable: false });
                    isClosed = true;

                    //update delivery path
                    changeDeliveryArea(path)
                    //show button clear
                    //$("#clear_area").show();
                });
            }
            //show button clear
            $("#clear_area").show();

            google.maps.event.addListener(markerArea, 'drag', function (dragEvent) {
                poly.getPath().setAt(markerIndex, dragEvent.latLng);
            });
            poly.getPath().push(latLng);
        }

        function initialize_existing_area(area_positions){
            for(var i=0; i<area_positions.length; i++){
                var markerAreaData = new google.maps.LatLng(area_positions[i].lat, area_positions[i].lng);
                markerArea = new google.maps.Marker({ map: map_area, position: markerAreaData, draggable: false, icon: area });

                //push markers
                markers.push(markerArea);

                //var path = poly.getPath();
                path = poly.getPath();

                poly.setMap(null);
                poly = new google.maps.Polygon({ map: map_area, path: path, strokeColor: "#FF0000", strokeOpacity: 0.8, strokeWeight: 2, fillColor: "#FF0000", fillOpacity: 0.35, editable: false });

                //show clear area
                isClosed = true;
                $("#clear_area").show();
                //google.maps.event.addListener(markerArea, "drag", update_polygon_closure(poly, i));
            }


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

        window.onload = function () {
            //var map, infoWindow, marker, lng, lat;

            //Working hours
            initializeWorkingHours();

            getLocation(function(isFetched, currPost){
                if(isFetched){
                    infoWindow = new google.maps.InfoWindow;

                    if(currPost.lat != 0 && currPost.lng != 0){
                        //initialize map
                        initializeMap(currPost.lat, currPost.lng)

                        //initialize marker
                        initializeMarker(currPost.lat, currPost.lng)

                        //var isClosed = false;

                        poly = new google.maps.Polyline({ map: map_area, path: currPost.area ? currPost.area : [], strokeColor: "#FF0000", strokeOpacity: 1.0, strokeWeight: 2 });

                        if(currPost.area != null){
                            initialize_existing_area(currPost.area)
                        }

                        map_location.addListener('click', function(event) {
                            marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));

                            changeLocation(event.latLng.lat(), event.latLng.lng());
                        });

                        map_area.addListener('click', function(event) {
                            new_delivery_area(event.latLng)
                        });
                    }else{
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                var pos = { lat: position.coords.latitude, lng: position.coords.longitude };

                                //infoWindow.setPosition(pos);
                                //infoWindow.setContent('Location found.');
                                //infoWindow.open(map);

                                //initialize map
                                initializeMap(position.coords.latitude, position.coords.longitude)

                                //initialize marker
                                initializeMarker(position.coords.latitude, position.coords.longitude)

                                //change location in database
                                changeLocation(pos.lat, pos.lng);

                                map_location.addListener('click', function(event) {
                                    marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));

                                    changeLocation(event.latLng.lat(), event.latLng.lng());
                                });

                                map_area.addListener('click', function(event) {
                                    new_delivery_area(event.latLng)
                                });
                            }, function() {
                                // handleLocationError(true, infoWindow, map.getCenter());

                                //initialize map
                                initializeMap(54.5260, 15.2551)

                                //initialize marker
                                initializeMarker(54.5260, 15.2551)

                                map_location.addListener('click', function(event) {
                                    marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));

                                    changeLocation(event.latLng.lat(), event.latLng.lng());
                                });

                                map_area.addListener('click', function(event) {
                                    new_delivery_area(event.latLng)
                                });
                            });
                        } else {
                            // Browser doesn't support Geolocation
                            //handleLocationError(false, infoWindow, map.getCenter());
                        }
                    }
                }
            });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
        
        CKEDITOR.replace( 'ckeditor',
         {
          customConfig : 'config.js',
          toolbar : 'simple'
          })
    </script>
    <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['title' => __('Orders')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/qrcode/resources/views/restorants/edit.blade.php ENDPATH**/ ?>