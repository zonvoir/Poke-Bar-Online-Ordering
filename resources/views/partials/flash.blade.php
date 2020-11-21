@if (session('status'))
    <div class="alert_massge_cus alert alert-success alert-dismissible fade show" role="alert">
        <img src="{{asset('images')}}/icons/white_bg_check.png" class="img-responsive" alt="Image">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        
        
    </div>
@endif
@if (session('error'))
    <div class="alert_massge_cus alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
         <img src="{{asset('images')}}/icons/close.png" class="img-responsive" alt="Image">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif