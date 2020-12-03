@extends('general.index', $setup);
@section('tbody')
@foreach ($setup['items'] as $item)
<tr id="{{ $item->id}}">
    <td class="d-none">{{ $item->id}}</td>
    <td>{{ $item->chat_id }}</td>
    <td>{{ $item->message }}</td>
    <td>{{ $item->reciever }}</td>
    <td>{{ $item->created_at}}</td>
    <td style="min-width: 190px">
        <div class="input-group mb-3">
          <input class="form-control" type="text" value="{{ $item->response_msg}}">
    </div>
</td>
 <td>{{ $item->restorant->name }}</td>
</tr> 
@endforeach
@endsection