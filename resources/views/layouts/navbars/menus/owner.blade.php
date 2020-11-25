<ul class="navbar-nav">
    @if(config('app.ordering'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/live">
                <i class="ni ni-basket text-success"></i> {{ __('Live Orders') }}<div class="blob red"></div>
            </a>
        </li>
    
    
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="ni ni-basket text-orange"></i> {{ __('Orders') }}
            </a>
        </li>  
    @endif 
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.restaurants.edit',  auth()->user()->restorant->id) }}">
            <i class="ni ni-shop text-info"></i> {{ __('Restaurant') }}
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{ route('ingredients.index') }}">
            <i class="ni ni-ui-04 text-pink"></i> {{ __('Ingredients') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="ni ni-collection text-pink"></i> {{ __('Menu') }}
        </a>
    </li>

    @if (config('app.isqrsaas') && env('ENABLE_QR_ORDERING',true))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.restaurant.tables.index') }}">
                <i class="ni ni-ungroup text-red"></i> {{ __('Tables') }}
            </a>
        </li>
    @endif

    @if (config('app.isqrsaas'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('qr') }}">
                <i class="ni ni-mobile-button text-red"></i> {{ __('QR Builder') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.restaurant.visits.index') }}">
                <i class="ni ni-calendar-grid-58 text-blue"></i> {{ __('Customers log') }}
            </a>
        </li>
    @endif

    @if(env('ENABLE_PRICING',false))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('plans.current') }}">
                <i class="ni ni-credit-card text-orange"></i> {{ __('Plan') }}
            </a>
        </li>
    @endif
    
        @if(config('app.ordering')&&env('ENABLE_FINANCES_OWNER',true))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('finances.owner') }}">
                    <i class="ni ni-money-coins text-blue"></i> {{ __('Finances') }}
                </a>
            </li>
        @endif
    
</ul>
