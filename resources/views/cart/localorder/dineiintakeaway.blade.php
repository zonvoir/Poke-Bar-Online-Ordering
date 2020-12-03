

<div class="card card-profile shadow">
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Dine In / Takeaway') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
       
        <div class="custom-control custom-radio mb-3">
          <input name="dineType" class="custom-control-input" id="deliveryTypeDinein" type="radio" value="dinein" checked>
          <label class="custom-control-label" for="deliveryTypeDinein">{{ __('Dine In') }}</label>
        </div>
        <div class="custom-control custom-radio mb-3">
          <input name="dineType" class="custom-control-input" id="deliveryTypeTakeAway" type="radio" value="takeaway">
          <label class="custom-control-label" for="deliveryTypeTakeAway">{{ __('Takeaway') }}</label>
        </div>
      </div>
      <br />
      <br />
    </div>
    
    
    
    <div class="card card-profile shadow tablepicker">
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Table') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        <input type="hidden" value="{{$restorant->id}}" id="restaurant_id"/>
        @include('partials.select',$tables)
      </div>
      <br />
      <br />
    </div>
  </div>
  <br />

    
    
  </div>
 
<!-- 

<div class="panel_card_tabs card  ">
  <!-- Nav pills -->
<!--   <ul class="nav nav-pills mt-5" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#dine_in">Takeaway</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#table_tabs">Dine In</a>
    </li>
   
  </ul> -->

  <!-- Tab panes -->
<!--   <div class="tab-content">
    <div id="dine_in" class=" tab-pane active">
      
        
        <div class="">
            <div class=""> -->
<!--
                <div class="mt-5">
                    <h3><span class="delTime delTimeTS">{{ __('Delivery time') }}</span><span class="picTime picTimeTS">{{ __('Pickup time') }}</span><span class="font-weight-light"></span></h3>
                </div>
-->
             <!--    <div class="card-content border-top">
                   <lable class="mar_time_sec">{{ __('Pickup time') }}</lable>
                    <br>
                    <select name="timeslot" id="timeslot" class="form-control{{ $errors->has('timeslot') ? ' is-invalid' : '' }}" required>
                        @foreach ($timeSlots as $value => $text)
                        <option value={{ $value }}>{{$text}}</option>
                        @endforeach
                    </select>
                </div>
                <br />

            </div>
        </div>

        
      
    </div>
    <div id="table_tabs" class=" tab-pane fade"> -->
<!--
        <div class="">
        <h3>{{ __('Table') }}<span class="font-weight-light"></span></h3>
      </div>
-->
        
     <!--  <div class="card-content border-top">
           <lable>{{ __('Table') }}</lable>
        <input type="hidden" value="{{$restorant->id}}" id="restaurant_id"/>
        @include('partials.select',$tables)
      </div>
    </div>
  </div>
</div>

 <br /> -->
 