<div class="form-group{{ $errors->has($id) ? ' has-danger' : '' }}  @isset($class) {{$class}} @endisset">
   @if(!(isset($type)&&$type=="hidden"))
   <label class="form-control-label {{isset($lableVsisibility) && $lableVsisibility == 'invisible' ? $lableVsisibility : ''}}" for="{{ $id }}">{{ __($name) }}@isset($link)<a target="_blank" href="{{$link}}">{{$linkName}}</a>@endisset</label>
   @endif
   <input @isset($accept) accept="{{ $accept }}" @endisset step=".01" type="{{ isset($type)?$type:"text"}}" name="{{ $id }}" id="{{ $id }}" class="form-control form-control-alternative @isset($editclass) {{$editclass}} @endisset  {{ $errors->has($id) ? ' is-invalid' : '' }}" placeholder="{{ __($placeholder) }}" value="{{ old($id)?old($id):(isset($value)?$value:(app('request')->input($id)?app('request')->input($id):null)) }}" <?php if($required) {echo 'required';} ?> <?php if(isset($disabled) && $disabled) {echo 'disabled';} ?> autofocus>
   @isset($additionalInfo)
   <small class="text-muted"><strong>{{ __($additionalInfo) }}</strong></small>
   @endisset
   @if ($errors->has($id))
   <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first($id) }}</strong>
</span>
@endif
</div>