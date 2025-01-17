<div class="card card-profile shadow">
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Delivery Address') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        <input type="hidden" value="{{$restorant->id}}" id="restaurant_id"/>
        <div class="form-group{{ $errors->has('addressID') ? ' has-danger' : '' }}">
            @if(count($addresses))
                <select name="addressID" id="addressID" class="form-control{{ $errors->has('addressID') ? ' is-invalid' : '' }}" required>
                    <option disabled selected value> {{__('-- select an option -- ')}}</option>
                    @foreach ($addresses as $key => $address)
                        @if(env('ENABLE_COST_PER_DISTANCE',false))
                            <option data-cost={{ $address->cost_per_km}} id="{{ 'address'.$address->id }}"  <?php if(!$address->inRadius){echo "disabled";} ?> value={{ $address->id }}>{{$address->address." - ".money( $address->cost_per_km, env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true)) }} </option>
                        @else
                    <option data-cost={{ config('global.delivery')}} id="{{ 'address'.$address->id }}" <?php if(!$address->inRadius){echo "disabled";} ?> value={{ $address->id }}>{{$address->address}} </option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('addressID'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('addressID') }}</strong>
                    </span>
                @endif
            @else
                <h6 id="address-complete-order">{{ __('You don`t have any address. Please add new one') }}.</h6>
            @endif
        </div>
        <div class="form-group">
            <button type="button" data-toggle="modal" data-target="#modal-order-new-address"  class="btn btn-outline-success">{{ __('Add new') }}</button>
        </div>
        <input type="hidden" name="deliveryCost" id="deliveryCost" value="0" />
      </div>
      <br />
   
    </div>
  </div>
  <br />
