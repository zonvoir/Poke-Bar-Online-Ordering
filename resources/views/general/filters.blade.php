<br/>
<div class="tab-content orders-filters">
    <form>
        <div class="row">
            @php unset($fields[13]);unset($fields[12]);$fields[2]['required']=false;$fields[2]['required']=false; @endphp
            @include('partials.fields',['fiedls'=>$fields])
        </div>

        <div class="col-md-6 offset-md-6">
            <div class="row">
                @if ($parameters)
                    <div class="col-md-4">
                        <a href="{{ Request::url() }}" class="btn btn-md btn-block">{{ __('crud.clear_filters') }}</a>
                    </div>
                    <div class="col-md-4">
                    <a href="{{Request::fullUrl()."&report=true" }}" class="btn btn-md btn-success btn-block">{{ __('crud.download_report') }}</a>
                    </div>
                @else
                    <div class="col-md-8"></div>
                @endif

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-md btn-block">{{ __('crud.filter') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>