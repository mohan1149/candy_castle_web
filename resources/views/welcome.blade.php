<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="{{ asset('cc') }}/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('sas') }}/js/sas.js"></script>
        <title>SAS - Salon Adminal System</title>
    </head>
    <body>
        @isset($output)
            <div class="w3-panel w3-yellow w3-card w3-round sas_alert">
                <p>
                    {{ $output['msg'] }}
                </p>
            </div>        
        @endisset
        <section>
            <div class="full_width_login_container">
                <div class="login_form">
                    <h4>{{__('t.login_to_continue')}}</h4>
                    <form action="/admin/login" method="post">
                        @csrf
                        {{-- civil id --}}
                        <label for="civil_id">{{__('t.civil_id')}}</label>
                        <input class="w3-input w3-border" type="text" name="civil_id" id="civil_id">
                        {{-- password --}}
                        <label for="password">{{__('t.password')}}</label>
                        <input class="w3-input w3-border" type="password" name="password" id="password">
                        {{-- submit --}}
                        <input class="w3-button w3-center w3-margin-top w3-pink" type="submit" value={{ __('t.login') }}>
                        <a class="w3-right w3-margin-top" href="/forgot/password">{{ __('t.forgot_password') }}</a>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
