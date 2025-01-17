@extends('layouts.front', ['title' => __('User Profile')])
@if (strlen(env('RECAPTCHA_SITE_KEY',""))>2)
    @section('head')
    {!! htmlScriptTagJsApi([]) !!}
    @endsection
@endif

@section('content')
    @include('users.partials.header', ['title' => __(''),])
    <div class="container-fluid mt--7">
        <div class="row">
            </div>
            <div class="col-xl-8 offset-xl-2">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ $setup['title'] }}</h3>
                        </div>
                    </div>
                    <div class="card-body cu_card_b">
                        <form action="{{ $setup['action'] }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($setup['isupdate'])
                                @method('PUT')
                            @endisset
                            @isset($setup['inrow'])
                                <div class="row">
                            @endisset
                                @include('partials.fields',['fields'=>$fields])
                            @isset($setup['inrow'])
                                </div>
                            @endisset
                            <br />
                            @isset($setup['action_link'])
                                <a href="{{ $setup['action_link'] }}" class="btn btn-secondary">{{ $setup['action_name'] }}</a>
                            @endisset

                            @if (isset($setup['isupdate']))
                                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>  
                            @else
                                <button type="submit" class="btn btn-primary">{{ __('Visit')}}</button>  
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
@endsection

@section('js')
@if (isset($_GET['name'])&&$errors->isEmpty())
<script>
    "use strict";
    document.getElementById("thesubmitbtn").click(); 
</script> 
@endif
<script src="{{ asset('js') }}/bootstrap-input-spinner.js"></script>
<script>
    $("#duration").inputSpinner()
</script>
@endsection