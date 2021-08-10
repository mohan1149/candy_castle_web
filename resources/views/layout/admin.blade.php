<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="/home"><img src="{{ asset('sas') }}/images/logo.png" width="120px" alt=""></a>
                </div>
                {{-- home --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/home" class="w3-button {{ Request::segment(1) == 'home' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-home"></i>
                        <span>{{__("t.home")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/settings" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-cog"></i>
                            <span>{{__("t.settings")}}</span>
                        </a>
                        <a href="/console" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-laptop"></i>
                            <span>{{__("t.console")}}</span>
                        </a>
                        <a href="/profile" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-user"></i>
                            <span>{{__("t.profile")}}</span>
                        </a>
                    </div>
                  </div>
                {{-- salons --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/salons" class="w3-button {{ Request::segment(1) == 'salons' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-spa"></i>
                        <span>{{__("t.salons")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/salons/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_salon")}}</span>
                        </a>
                    </div>
                </div>
                {{-- services --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/services" class="w3-button {{ Request::segment(1) == 'services' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-heart"></i>
                        <span>{{__("t.services")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/services/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_service")}}</span>
                        </a>
                        <a href="/service-categories" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-layer-group"></i>
                            <span>{{__("t.service_categories")}}</span>
                        </a>
                        <a href="/service-categories/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_category")}}</span>
                        </a>
                        
                    </div>
                </div>
                {{-- employes --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/employees" class="w3-button {{ Request::segment(1) == 'employees' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-id-badge"></i>
                        <span>{{__("t.employees")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/employees/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_employee")}}</span>
                        </a>
                    </div>
                </div>
                {{-- bookings --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/bookings" class="w3-button {{ Request::segment(1) == 'bookings' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-calendar-alt"></i>
                        <span>{{__("t.bookings")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/bookings/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_booking")}}</span>
                        </a>
                    </div>
                </div>
                {{-- categories --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/categories" class="w3-button {{ Request::segment(1) == 'categories' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-layer-group"></i>
                        <span>{{__("t.categories")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/categories/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_category")}}</span>
                        </a>
                    </div>
                </div>
                {{-- products --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/products" class="w3-button {{ Request::segment(1) == 'products' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-shopping-cart"></i>
                        <span>{{__("t.products")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/products/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_product")}}</span>
                        </a>
                    </div>
                </div>
                {{-- orders --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/orders" class="w3-button {{ Request::segment(1) == 'orders' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-list-alt"></i>
                        <span>{{__("t.orders")}}</span>
                    </a>
                    {{-- <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/console" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add")}}</span>
                        </a>
                    </div> --}}
                </div>
                {{-- customers --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/customers" class="w3-button {{ Request::segment(1) == 'customers' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-users"></i>
                        <span>{{__("t.customers")}}</span>
                    </a>
                    <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        
                        <a href="/customers/create" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add_customer")}}</span>
                        </a>
                    </div>
                </div>
                {{-- reports --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/reports" class="w3-button {{ Request::segment(1) == 'reports' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-chart-bar"></i>
                        <span>{{__("t.reports")}}</span>
                    </a>
                    {{-- <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/reports" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-list"></i>
                            <span>{{__("t.list")}}</span>
                        </a>
                        <a href="/console" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add")}}</span>
                        </a>
                    </div> --}}
                </div>
                {{-- sales --}}
                <div class="w3-dropdown-hover sas-sidebar-item">
                    <a href="/sales" class="w3-button {{ Request::segment(1) == 'sales' ? 'w3-pink' : ' w3-white' }}">
                        <i class="fa-fw fas fa-dollar-sign"></i>
                        <span>{{__("t.sales")}}</span>
                    </a>
                    {{-- <div class="w3-dropdown-content w3-card w3-bar-block w3-border">
                        <a href="/sales" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-list"></i>
                            <span>{{__("t.list")}}</span>
                        </a>
                        <a href="/console" class="w3-bar-item w3-button">
                            <i class="fa-fw fas fa-plus"></i>
                            <span>{{__("t.add")}}</span>
                        </a>
                    </div> --}}
                </div>
            </div>
        </nav>
        <main class="sas-content">
            <header>
                <div class="sas-header w3-card-2 w3-padding w3-margin-bottom">
                    <div class="w3-bar">
                        <h5 class="w3-bar-item">{{__('t.welcome_to_sas')}}</h5>
                        <h5 class="w3-bar-item w3-right"><a href="settings"><i class="fas fa-user w3-text-pink"></i> {{ __('t.profile') }}</a></h5>
                        <h5 class="w3-bar-item w3-right"><a href="/lang"><i class="fas fa-globe w3-text-pink"></i> {{ app()->getLocale() == 'ar' ? 'English':'العربية' }}</a></h5> 
                        <h5 class="w3-bar-item w3-right"><a href="/console"><i class="fas fa-laptop w3-text-pink"></i> {{ __('t.console') }}</a></h5>
                        <h5 class="w3-bar-item w3-right"><a href="settings"><i class="fas fa-cog w3-text-pink"></i> {{ __('t.settings') }}</a></h5> 
                    </div>
                </div>
            </header>
            @yield('content')
        </main>
        <footer></footer>
    </body>
    @yield('javascript')
</html>
