@extends('layouts.app', ['title' => __('Pages')])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>


    <div class="container-fluid mt--7">
        
        <div class="row">

            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            @foreach ($plans as $plan)
            <div class="col-md-{{ $col}}">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $plan['name'] }}</h3>
                            </div>
                            <div class="col-4">
                                <h3 class="mb-0">@money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}</h3>
                            </div>
                            
                        </div>
                    </div>

                    
                    @if(count($plans))
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Features') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (explode(",",$plan['features']) as $feature)
                                    <tr>
                                        <td>{{ __($feature) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                        
                    </div>
                    @endif
                    <div class="card-footer py-4">
                        @if($currentPlan&&$plan['id'].""==$currentPlan->id."")
                            <a href="" class="btn btn-primary disabled">{{__('Current Plan')}}</a>
                        @else

                        

                            @if(strlen($plan['paddle_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paddle')
                                <a href="javascript:openCheckout({{ $plan['paddle_id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                            @endif
                            @if(strlen($plan['stripe_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe')
                            <a href="javascript:showStripeCheckout({{ $plan['id'] }} , '{{ $plan['name'] }}')" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>


        <div class="row mt-4" id="stripe-payment-form-holder" style="display: none">
            <div class="col-md-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Subscribe to') }} <span id="plan_name">PLAN_NAME</span></h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">

                    <form action="{{ route('plans.subscribe') }}" method="post" id="stripe-payment-form"   >
                            @csrf
                            <input name="plan_id" id="plan_id" type="hidden" />
                            <div style="width: 100%;" class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input name="name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __( 'Name on card' ) }}" value="{{auth()->user()?auth()->user()->name:""}}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <div class="form">
                                <div style="width: 100%;" #stripecardelement  id="card-element" class="form-control">
                        
                                <!-- A Stripe Element will be inserted here. -->
                              </div>
                        
                              <!-- Used to display form errors. -->
                              <br />
                              <div class="" id="card-errors" role="alert">
                        
                              </div>
                          </div>
                          <div class="text-center" id="totalSubmitStripe">
                            <button
                                v-if="totalPrice"
                                type="submit"
                                class="btn btn-success mt-4 paymentbutton"
                                >{{ __('Subscribe') }}</button>
                          </div>
                        
                          </form>


                    </div>
                </div>
            </div>
        </div>

        
        @if($currentPlan)
       
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Your current plan') }}</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ __('You are currently using the ').$currentPlan->name." ".__('plan') }}<p>
                            @if(strlen(auth()->user()->plan_status)>0)
                            <p>{{ __('Status').": "}} <strong>{{ auth()->user()->plan_status }}</strong><p>
                            @endif
                    </div>
                    @if(strlen(auth()->user()->cancel_url)>5)
                    <div class="card-footer py-4">
                        <a href="{{ auth()->user()->update_url }}" target="_blank" class="btn btn-warning">{{__('Update subscription')}}</a>
                        <a href="{{ auth()->user()->cancel_url }}" target="_blank" class="btn btn-danger">{{__('Cancel subscription')}}</a>
                    </div>
                    @endif
                </div>
                
            </div>
            
        </div>
        @endif


        @include('layouts.footers.auth')
    </div>
@endsection
@section('js')
 <!-- Stripe -->
 <script src="https://js.stripe.com/v3/"></script>
 
<script>
  "use strict";
  var STRIPE_KEY="{{ env('STRIPE_KEY',"") }}";
  var ENABLE_STRIPE="{{ env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe' }}";
  if(ENABLE_STRIPE){
      js.initStripe(STRIPE_KEY,"stripe-payment-form");
  }

  function showStripeCheckout(plan_id,plan_name){
   $('#plan_id').val(plan_id);
   $('#plan_name').html(plan_name);
   $('#stripe-payment-form-holder').show();
  }
</script>
<script src="{{ asset('custom') }}/js/checkout.js"></script>


<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
<script type="text/javascript">
    "use strict";
    var paddleVendorID={{ env('paddleVendorID','')}};
    var currentUserEmail="{{ auth()->user()->email }}";
    Paddle.Setup({ vendor: paddleVendorID  });
	function openCheckout(product_id) {
		var form = document.getElementById('pre-checkout');
		Paddle.Checkout.open({
			product: product_id,
			email: currentUserEmail
		});
	}
</script>
@endsection
