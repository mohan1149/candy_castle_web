<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="{{ asset('cc') }}/css/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/2d6b835a4d.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <script src="{{ asset('cc') }}/js/sas.js"></script>
        @yield('css')
        <title>SAS - Salon Adminal System</title>
    </head>
    <body>
        <div class="w3-modal ajax_indicator">
            <div class="w3-modal-content">
                <span><i class="fas fa-sync-alt w3-animate w3-spin"></i></span>
            </div>
        </div>
        <div class="w3-modal ajax_indicator_failed">
            <div class="w3-modal-content">
                <p>{{ __('t.unable_to_process')}}</p>
                <button class="w3-button w3-pink w3-round close_ajax_error">{{ __('t.close') }}</button>
            </div>
        </div>


        @isset($output)
            <div class="w3-panel w3-yellow w3-card w3-round sas_alert">
                <p>
                    {{ $output['msg'] }}
                </p>
            </div>        
        @endisset
        <nav class="w3-sidebar w3-collapse w3-card sas-sidebar">
            <div class="w3-bar-block sas-sidebar-container">
                <div>
                    <img src="{{ asset('cc') }}/images/logo.png" width="120px" alt="">
                </div>
                {{-- home --}}
                <a href="/home" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'dashboard' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-home"></i>
                        <span>{{__("t.dashboard")}}</span>
                    </div>
                </a>
                {{-- services --}}
                <a href="/services" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'services' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-heart"></i>
                        <span>{{__("t.services")}}</span>
                    </div>
                </a>
                {{-- employes --}}
                <a href="/employees" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'employees' ? 'w3-card sas-sidebar-item-active' : '' }}">
                    <i class="fa-fw fas fa-id-badge"></i>
                    <span>{{__("t.employees")}}</span>
                </div>
                </a>
                {{-- bookings --}}
                <a href="/bookings" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'bookings' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-calendar-alt"></i>
                        <span>{{__("t.bookings")}}</span>
                    </div>
                </a>
                {{-- categories --}}
                <a href="/categories" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'categories' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-layer-group"></i>
                        <span>{{__("t.categories")}}</span>
                    </div>
                </a>
                {{-- products --}}
                <a href="/products" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'products' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-shopping-cart"></i>
                        <span>{{__("t.products")}}</span>
                    </div>
                </a>
                {{-- orders --}}
                <a href="/orders" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'orders' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-list-alt"></i>
                        <span>{{__("t.orders")}}</span>
                    </div>
                </a>
                {{-- customers --}}
                <a href="/customers" class="w3-bar-item w3-button sas-sidebar-item">
                    <div class="sas-sidebar-item_content {{ Request::segment(1) == 'customers' ? 'w3-card sas-sidebar-item-active' : '' }}">
                        <i class="fa-fw fas fa-users"></i>
                        <span>{{__("t.customers")}}</span>
                    </div>
                </a>
            </div>
        </nav>
        <main class="sas-content">
            <header>
                <div class="sas-header w3-card-2 w3-padding w3-margin-bottom">
                    <div class="w3-bar">
                        <h5 class="w3-bar-item">Welcome to SAS.!</h5>
                        <h5 class="w3-bar-item w3-right"><a href="settings"><i class="fas fa-user w3-text-pink"></i> {{ __('t.profile') }}</a></h5>
                        <h5 class="w3-bar-item w3-right"><a href="settings"><i class="fas fa-globe w3-text-pink"></i> {{ __('t.language') }}</a></h5> 
                        <h5 class="w3-bar-item w3-right"><a href="/console"><i class="fas fa-laptop w3-text-pink"></i> {{ __('t.console') }}</a></h5>
                    </div>
                </div>
            </header>
            @yield('content')
        </main>
        <footer></footer>
    </body>
    @yield('javascript')
</html>
