<div class="form-group{{ $errors->has($id) ? ' has-danger' : '' }}  @isset($class) {{$class}} @endisset">
    
    @if(isset($link)&&!(isset($type)&&$type=="hidden"))
       <label class="form-control-label" for="{{ $id }}">{{ __($name) }}@isset($link)<a target="_blank" href="{{$link}}">{{$linkName}}</a>@endisset</label>
   @endif
   <div class="custom-control custom-checkbox">
        <input type='hidden' value='false' name="{{ $id }}" id="{{ $id }}hid">
        <input value="true" @if(isset($value)&&$value=="true") checked @endif  type="checkbox" class="custom-control-input" name="{{ $id }}" id="{{ $id }}">
        <label class="custom-control-label" for="{{ $id }}">{{ __($name) }}</label>
   </div>
   @isset($additionalInfo)
       <small class="text-muted"><strong>{{ __($additionalInfo) }}</strong></small>
   @endisset
   @if ($errors->has($id))
       <span class="invalid-feedback" role="alert">
           <strong>{{ $errors->first($id) }}</strong>
       </span>
   @endif
</div>
