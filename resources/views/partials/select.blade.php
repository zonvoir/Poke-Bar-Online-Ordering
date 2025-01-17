
<div class="form-group {{ $errors->has($id) ? ' has-danger' : '' }}  @isset($class) {{$class}} @endisset">

    <label class="form-control-label">{{ __($name) }}</label><br />

    <select class="form-control form-control-alternative"  name="{{ $id }}" id="{{  $id }}">
        <option selected value> {{ __('Select')." ".__($name)}} </option>
        @if(isset($data) && !empty($data))
        @foreach ($data as $key => $item)
            @if (old($id)&&old($id).""==$key."")
                <option  selected value="{{ $key }}">{{ __($item) }}</option>
            @elseif (isset($value)&&strtoupper($value."")==strtoupper($key.""))
                <option  selected value="{{ $key }}">{{ __($item) }}</option>
            @elseif (app('request')->input($id)&&strtoupper(app('request')->input($id)."")==strtoupper($key.""))
                <option  selected value="{{ $key }}">{{ __($item) }}</option>
            @else
                <option value="{{ $key }}">{{ __($item) }}</option>
            @endif
        @endforeach
        @endif
    </select>


    @isset($additionalInfo)
        <small class="text-muted"><strong>{{ __($additionalInfo) }}</strong></small>
    @endisset
    @if ($errors->has($id))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($id) }}</strong>
        </span>
    @endif
</div>
