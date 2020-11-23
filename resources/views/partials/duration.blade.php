<div class="form-group{{ $errors->has($id) ? ' has-danger' : '' }}  @isset($class) {{$class}} @endisset">
   @if(!(isset($type)&&$type=="hidden"))
   <label class="form-control-label" for="{{ $id }}">{{ __($name) }}@isset($link)<a target="_blank" href="{{$link}}">{{$linkName}}</a>@endisset</label>
   @endif
   <input @isset($accept) accept="{{ $accept }}" @endisset data-suffix="Hour" min="1" max="8" type="{{ isset($type)?$type:"number"}}" name="{{ $id }}" id="{{ $id }}" class="form-control form-control-alternative @isset($editclass) {{$editclass}} @endisset  {{ $errors->has($id) ? ' is-invalid' : '' }}"  value="{{ old($id)?old($id):(isset($value)?$value:(app('request')->input($id)?app('request')->input($id):null)) }}" <?php if(isset($required)) {echo 'required';} ?> <?php if(isset($disabled) && $disabled) {echo 'disabled';} ?> autofocus>
   @isset($additionalInfo)
   <small class="text-muted"><strong>{{ __($additionalInfo) }}</strong></small>
   @endisset
   @if ($errors->has($id))
   <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first($id) }}</strong>
</span>
@endif
</div>