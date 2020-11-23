@extends('general.index', $setup);
@section('tbody')
    @foreach ($setup['items'] as $item)
        <tr>
            <td>{{ $item->duration == 1 ? $item->duration.' Hour' : $item->duration.' Hours' }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone_number}}</td>
            <td>{{ $item->table?$item->table->name:"NA" }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->by=="1"?__('customers.by_restaurant'):__('customers.him_self') }}</td>
            <td>{{ $item->entry_time }}</td>
            @include('partials.tableactions',$setup)
        </tr> 
    @endforeach
@endsection