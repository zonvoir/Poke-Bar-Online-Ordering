<?php
$lastStatusAlisas=$order->status->pluck('alias')->last();
?>
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
@role('admin')
<script>
    function setSelectedOrderId(id){
        $("#form-assing-driver").attr("action", "updatestatus/assigned_to_driver/"+id);
    }
</script>
<td>
    @if($lastStatusAlisas == "just_created")
    <a href="{{'updatestatus/accepted_by_admin/'.$order->id }}" class="btn btn-success btn-sm order-action">{{ __('Accept') }}</a>
    <a href="{{'updatestatus/rejected_by_admin/'.$order->id }}" class="btn btn-danger btn-sm order-action">{{ __('Reject') }}</a>
    @elseif($lastStatusAlisas == "accepted_by_restaurant"&&$order->delivery_method.""!="2")
    <button type="button" class="btn btn-primary btn-sm order-action" onClick=(setSelectedOrderId({{ $order->id }}))  data-toggle="modal" data-target="#modal-asign-driver">{{ __('Assign to driver') }}</a>
        @elseif($lastStatusAlisas == "prepared"&&$order->driver==null)
        <button type="button" class="btn btn-primary btn-sm order-action" onClick=(setSelectedOrderId({{ $order->id }}))  data-toggle="modal" data-target="#modal-asign-driver">{{ __('Assign to driver') }}</a>
            @else
            <small>{{ __('No actions for you right now!') }}</small>
            @endif
        </td>
        @endrole
        @role('owner')
        <td>
            @if(!config('app.isqrsaas'))
            @if($lastStatusAlisas == "accepted_by_admin")
            <a href="{{ url('updatestatus/accepted_by_restaurant/'.$order->id) }}" class="btn btn-success btn-sm order-action">{{ __('Accept') }}</a>
            <a href="{{ url('updatestatus/rejected_by_restaurant/'.$order->id) }}" class="btn btn-danger btn-sm order-action">{{ __('Reject') }}</a>
            @elseif($lastStatusAlisas == "assigned_to_driver"||$lastStatusAlisas == "accepted_by_restaurant")
            <a href="{{ url('updatestatus/prepared/'.$order->id) }}" class="btn btn-primary btn-sm order-action">{{ __('Prepared') }}</a>
            @elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "accepted_by_restaurant")
            <a href="{{ url('updatestatus/prepared/'.$order->id) }}" class="btn btn-primary btn-sm order-action">{{ __('Prepared') }}</a>
            @elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "prepared")
            <a href="{{ url('updatestatus/delivered/'.$order->id) }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
            @elseif($lastStatusAlisas == "prepared"&&$order->delivery_method.""=="2")
            <a href="{{ url('updatestatus/delivered/'.$order->id) }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
            <!--sushant 20-11-2020 -->
            @elseif($lastStatusAlisas == "closed")
            @if(isset($order->raitings->rating) && !empty($order->raitings->rating))
            @foreach($order->raitings->rating as $rate)
            <span class="fa fa-star" style="color: orange;"></span>
            @endforeach
            @endif
            <!--sushant 20-11-2020 -->
            @else
            <small>{{ __('No actions for you right now!') }}</small>
            @endif
            @else

            @if($lastStatusAlisas == "just_created")
            <a href="{{ url('updatestatus/accepted_by_restaurant/'.$order->id) }}" class="btn btn-success btn-sm order-action">{{ __('Accept') }}</a>
            <a href="{{ url('updatestatus/rejected_by_restaurant/'.$order->id) }}" class="btn btn-sm btn-danger">{{ __('Reject') }}</a>
            @elseif($lastStatusAlisas == "accepted_by_restaurant")
            <a href="{{ url('updatestatus/prepared/'.$order->id) }}" class="btn btn-sm btn-primary">{{ __('Prepared') }}</a>
            @elseif($lastStatusAlisas == "prepared")
            <a href="{{ url('updatestatus/delivered/'.$order->id) }}" class="btn btn-sm btn-primary">{{ __('Delivered') }}</a>
            @elseif($lastStatusAlisas == "delivered")
            <a href="{{ url('updatestatus/closed/'.$order->id) }}" class="btn btn-sm btn-danger">{{ __('Close') }}</a>
            @elseif($lastStatusAlisas == "updated")
            <a href="{{ url('updatestatus/accepted_by_restaurant/'.$order->id) }}" class="btn btn-success btn-sm order-action">{{ __('Accept') }}</a>
            <a href="{{ url('updatestatus/rejected_by_restaurant/'.$order->id) }}" class="btn btn-sm btn-danger">{{ __('Reject') }}</a>
            <!--sushant 20-11-2020 -->
             @elseif($lastStatusAlisas == "closed")
            @if(isset($order->raitings->rating) && !empty($order->raitings->rating))
            @foreach($order->raitings->rating as $rate)
            <span class="fa fa-star" style="color: orange;"></span>
            @endforeach
            @endif
            <!--sushant 20-11-2020 -->
            @else
            <small>{{ __('No actions for you right now!') }}</small>
            @endif
            @endif
        </td>
        @endrole
        @role('driver')
        <td>
         @if($lastStatusAlisas == "prepared")
         <a href="{{'updatestatus/picked_up/'.$order->id }}" class="btn btn-primary btn-sm order-action">{{ __('Picked Up') }}</a>
         @elseif($lastStatusAlisas == "picked_up")
         <a href="{{'updatestatus/delivered/'.$order->id }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
         @else
         <small>{{ __('No actions for you right now!') }}</small>
         @endif
     </td>
     @endrole
     @endif
