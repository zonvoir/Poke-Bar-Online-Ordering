<ul class="navbar-nav">
    @if(config('app.ordering'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="ni ni-basket text-orange"></i> {{ __('Orders') }}
            </a>
        </li>
    @endif

    @if (!config('app.isqrsaas'))
                
                    <li class="nav-item">
                        <a class="nav-link" href="/live">
                            <i class="ni ni-basket text-success"></i> {{ __('Live Orders') }}<div class="blob red"></div>
                        </a>
                    </li>
                    
                    @if (!env('DISABLE_DELIVER',false))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('drivers.index') }}">
                            <i class="ni ni-delivery-fast text-pink"></i> {{ __('Drivers') }}
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.index') }}">
                            <i class="ni ni-single-02 text-blue"></i> {{ __('Clients') }}
                        </a>
                    </li>
                @endif


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.restaurants.index') }}">
                        <i class="ni ni-shop text-info"></i> {{ __('Restaurants') }}
                    </a>
                </li>

                @if(!config('app.isqrsaas'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reviews.index') }}">
                        <i class="ni ni-diamond text-info"></i> {{ __('Reviews') }}
                    </a>
                </li>
                @endif

                @if(env('MULTI_CITY',false))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cities.index') }}">
                        <i class="ni ni-building text-orange"></i> {{ __('Cities') }}
                    </a>
                </li>
                @endif

                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.index') }}">
                        <i class="ni ni-ungroup text-info"></i> {{ __('Pages') }}
                    </a>
                </li>

                @if(env('ENABLE_PRICING',false))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('plans.index') }}">
                        <i class="ni ni-credit-card text-orange"></i> {{ __('Pricing plans') }}
                    </a>
                </li>
                @endif

                @if(config('app.ordering')&&env('ENABLE_FINANCES_ADMIN',true))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('finances.admin') }}">
                            <i class="ni ni-money-coins text-blue"></i> {{ __('Finances') }}
                        </a>
                    </li>

                @endif

               

                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{ url('/admin/languages')."/".strtolower(session('applocale_change'))."/translations".(config('app.isqrsaas')?"?group=qrlanding":"") }}">
                        <i class="ni ni-world text-orange"></i> {{ __('Translations') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index') }}">
                        <i class="ni ni-settings text-black"></i> {{ __('Site Settings ') }}
                    </a>
                </li>
            </ul>
