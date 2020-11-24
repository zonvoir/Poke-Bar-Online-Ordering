@extends('layouts.front', ['class' => ''])
@section('content')
    <section class="section-profile-cover section-shaped my--1 d-none d-md-none d-lg-block d-lx-block">
        <!-- Circles background -->
        <img class="bg-image " src="{{ config('global.restorant_details_cover_image') }}" style="width: 100%;">
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">

        </div>
    </section>
    <section class="section bg-secondary cart_panel_cl">

      <div class="container">

          <div class="row">

            <!-- Left part -->
            <div class="col-md-7">

              <!-- List of items -->
              @include('cart.items')

             

              <form id="order-form" role="form" method="post" action="{{route('order.store')}}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @if (!config('app.isqrsaas')&&count($timeSlots)>0)
                  <!-- FOOD TIGER -->
                  <!-- Delivery method -->
                  @if (env('ENABLE_PICKUP',true))
                    @if (!env('DISABLE_DELIVER',false))
                      @include('cart.delivery')
                    @endif
                  @endif

                  <!-- Delivery time slot -->
                  @include('cart.time')

                  <!-- Delivery address -->
                  <div id='addressBox'>
                    @include('cart.address')
                  </div>

                  <!-- Comment -->
                  @include('cart.comment')


                @else
                <!-- QRSAAS -->


                <!-- DINE IN OR TAKEAWAY -->
                 @if (env('ENABLE_PICKUP',true))
                  @include('cart.localorder.dineiintakeaway')

                  <!-- Takeaway time slot -->
                  <div class="takeaway_picker" style="display: none">
                    @include('cart.time')
                  </div>

                 @endif
                  
                 <!-- LOCAL ORDERING -->
                 

                

                 <!-- Comment -->
                 @include('cart.comment')


                @endif

              <!-- Restaurant -->
              @include('cart.restaurant')
            </div>


          <!-- Right Part -->
          <div class="col-md-5">

            @if (count($timeSlots)>0||config('app.isqrsaas'))
                <!-- Payment -->
                @include('cart.payment')
            @else
                <!-- Closed restaurant -->
                @include('cart.closed')
            @endif


          </div>
        </div>


    </div>
    @include('clients.modals')
  </section>
@endsection
@section('js')
  
  <script async defer src= "https://maps.googleapis.com/maps/api/js?key=<?php echo env('GOOGLE_MAPS_API_KEY',''); ?>&callback=initAddressMap"></script>
  <!-- Stripe -->
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    "use strict";
    var STRIPE_KEY="{{ env('STRIPE_KEY',"") }}";
    var ENABLE_STRIPE="{{ env('ENABLE_STRIPE',false) }}";
    var initialOrderType="{{ !env('DISABLE_DELIVER',false)?'delivery':'pickup' }}";
  </script>
  <script src="{{ asset('custom') }}/js/checkout.js"></script>
@endsection

