@extends('general.index', $setup);
@section('tbody')
@foreach ($setup['items'] as $item)
<tr id="{{ $item->id}}">
    <td class="d-none">{{ $item->id}}</td>
    <td>{{ $item->duration == 1 ? $item->duration.' Hour' : $item->duration.' Hours' }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->phone_number}}</td>
    <td>{{ $item->table?$item->table->name:"NA" }}</td>
    <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}</td>
    <td>{{ $item->by=="1"?__('customers.by_restaurant'):__('customers.him_self') }}</td>
    <td>{{ isset($item->entry_time) ? \Carbon\Carbon::parse($item->entry_time)->toDayDateTimeString() : 'NA' }}</td>
    <td style="min-width: 190px">
        <div class="input-group mb-3">
          <input class="form-control col_out_time" type="text" value="{{ isset($item->out_time) ? \Carbon\Carbon::parse($item->out_time)->toDateTimeString() : 'NA' }}" style="border: 1px solid #cad1d7;border-radius: 5px;">
          <div class="input-group-prepend d-none" id="{{ $item->id}}_div_group">
            <span class="input-group-text" style="position:relative;left: -5px;"><i class="fa fa-check"></i></span>
        </div>
    </div>
</td>
@include('partials.tableactions',$setup)
</tr> 
@endforeach
@endsection