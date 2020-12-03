@extends('layouts.app', ['title' => __($title)])
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 mt--4">
   @isset($breadcrumbs)
   @include('general.breadcrumbs')
   @endisset
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __($title) }}</h3>
                        </div>

                        <div class="col-4 text-right">
                            @isset($action_link)
                            <a href="{{ $action_link }}" class="btn btn-sm btn-primary">{{ __($action_name) }}</a>
                            @endisset
                            @isset($action_link2) 
                            <a href="{{ $action_link2 }}" class="btn btn-sm btn-primary">{{ __($action_name2) }}</a>
                            @endisset
                            @isset($usefilter)
                            <button id="show-hide-filters" class="btn btn-icon btn-1 btn-sm btn-outline-secondary" type="button">
                                <span class="btn-inner--icon"><i id="button-filters" class="ni ni-bold-down"></i></span>
                            </button>
                            @endisset
                        </div>
                    </div>
                    @isset($usefilter)
                    @include('general.filters')
                    @endisset
                </div>

                <div class="col-12">
                    @include('partials.flash')
                </div>

                @if (isset($iscontent))
                <div class="card-body">
                    @yield('cardbody')
                </div>
                @else
                @if(count($items))
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="">
                        <thead class="thead-light">
                            @php unset($fields[11]) @endphp
                            @if(isset($fields))
                            @foreach ($fields as $field)
                            <th>{{ __( $field['name'] ) }}</th>
                            @endforeach 
                            @if($action_name)
                            <th>{{ __('crud.actions') }}</th>
                            @endif
                            @else
                            @yield('thead')
                            @endif
                        </thead>
                        <tbody>
                            @yield('tbody')
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="card-footer py-4">
                    @if(count($items))
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $items->links() }}
                    </nav>
                    @else
                    <h4>{{__('crud.no_items',['items'=>$item_names])}}</h4>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@section('js')
<script type="text/javascript">
    $('#out_time').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })
    $('#entry_time').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })
    
    $('.col_out_time').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onChange: function(selectedDates, dateStr, instance){
           var data ={ "_token": "{{ csrf_token() }}",'id':$(instance.element).parent().parent().parent().attr('id'), 'date':dateStr};
           $.post("{{route('update-out-time')}}",data, function(resp, status){
            if(resp.status == 'success'){
                $('#'+data.id+'_div_group').removeClass('d-none');
            }
        });
       }
   })
</script>
@endsection
@endsection