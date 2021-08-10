@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-margin">
        <audio id="notif_audio" loop src="{{ asset('sas') }}/audio/notif.mp3"></audio>
        <div class="w3-row">
            <div class="w3-col l6">
                <h3>{{ __('t.new_orders') }} . <button class="w3-button w3-circle w3-pink stop_audio"><i class="fas fa fa-bell bell" ></i></button></h3>
                <div class="w3-margin">
                    <div class="w3-row orders-container">
                        @foreach ($orders as $order)
                        @php
                            $delivery_address = json_decode($order->delivery_address);
                        @endphp
                        <div class="w3-col l4">
                            <div class="w3-margin-right w3-margin-top w3-card w3-round">
                                <div class="w3-padding-16">
                                    <h5 class="w3-center">KWD {{ $order->order_cost }}</h5>
                                    <h6 class="w3-center w3-opacity w3-padding">{{ $delivery_address->city.','. $delivery_address->area.','.$delivery_address->block.','.$delivery_address->street.','.$delivery_address->house }} </h6>
                                    <div class="w3-center">
                                        <a href="orders/{{ $order->id }}" target="_blank" class="w3-button w3-round w3-pink view_order">{{ __("t.view") }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="w3-col l6">
                <h3>{{ __('t.new_bookings') }}</h3>
                <div class="w3-margin">
                    <div class="w3-row">
                        <h4>order</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @section('javascript')
        <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                let audio = document.getElementById('notif_audio');
                var pusher = new Pusher(
                    'af61bccdf3af71ab6e81',
                    {
                        encrypted: true,
                        cluster:'ap2',
                    }
                );
                var channel = pusher.subscribe('order-status');
                channel.bind('App\\Events\\OrderPlaced', function(data) {
                    let order = data.event_data;
                    let address= JSON.parse(order.delivery_address);
                    console.log(address);
                    let widget = '<div class="w3-col l4">';
                    widget+= '<div class="w3-margin-right w3-margin-top w3-card w3-round">';
                    widget+= '<div class="w3-padding-16">';
                    widget+= '<h5 class="w3-center">KWD '+order.order_cost+'</h5>';
                    widget+= '<h6 class="w3-center w3-opacity w3-padding">'+ address.city + ','+ address.area+','+address.block+','+address.street+','+address.house+'</h6>';
                    widget+= '<div class="w3-center">';
                    widget+= '<a href="orders/'+order.id+'" target="_blank" class="w3-button w3-round w3-pink view_order">{{ __("t.view") }}</a>';
                    widget+= '</div></div></div></div>';
                    $('.orders-container').append(widget);
                    audio.play();
                    $('.bell').addClass('fa-bell');
                    $('.bell').removeClass('fa-bell-slash');
                });
                $('.stop_audio').click(()=>{
                   audio.pause();
                   $('.bell').removeClass('fa-bell');
                   $('.bell').addClass('fa-bell-slash');
                });
            });
        </script>
    @endsection
@endsection