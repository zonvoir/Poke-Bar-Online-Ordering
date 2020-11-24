<div class="card card-profile shadow">
    <div class="">
      <div class="mt-5">
        <h3>{{ __('Restaurant information') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        <div class="">
            <p>
                {{ $restorant->name }}<br />
                {{ $restorant->address }}<br />
                {{ $restorant->phone }}<br />
            </p>
            @if(!empty($openingTime) && !empty($closingTime))
                <p>{{ __('Today working hours') }}: {{ $openingTime . " - " . $closingTime }}</p>
            @endif
      </div>
      </div>
     

    </div>
  </div>
<br>

