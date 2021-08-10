@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        <div class="w3-bar w3-pink">
            <button class="w3-bar-item w3-button sas-tab-item active w3-blue" id="currency">{{__('t.currency')}}</button>
            <button class="w3-bar-item w3-button sas-tab-item" id="shipping">{{__('t.shipping')}}</button>
        </div>
        <div id="currency" class="sas-tab-content active">
            <div class="w3-border w3-padding w3-margin">
                <table class="w3-table w3-striped">
                    <thead>
                        <tr>
                            <th>{{ __('t.currency') }}</th>
                            <th>{{ __('t.currency_code') }}</th>
                            <th>{{ __('t.multplier') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['currency'] as $currency)
                            <tr>
                                <td>{{ $currency->currency }}</td>
                                <td>{{ $currency->currency_code }}</td>
                                <td>{{ $currency->base_multiplier }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
          
        <div id="shipping" class="sas-tab-content">
            <div class="w3-border w3-padding w3-margin">
                <h2>{{ __('t.shipping_charge')}}</h2>
                @if ($data['shipping_charge'] == null)
                    <button class="w3-button w3-blue sas-modal-button">{{ __('t.add_shipping_charge') }}</button>
                    <div id="sas-modal" class="w3-modal">
                        <div class="w3-modal-content w3-animate-top w3-padding">
                            <span class="w3-button w3-display-topright sas-modal-close-button">&times;</span>
                            <h3>{{__('t.add_shpping_charge')}}</h3>
                            {!! Form::open(['url' => "/set-shipping-charge", 'method' => 'POST', 'id' => 'add_shiping_charge','files'=>true ]) !!}
                            {!! Form::label('shipping_charge', __('t.charge')) !!}
                            {!! Form::text('shipping_charge', null, ['class'=>'w3-input w3-border']) !!}
                            {!! Form::submit(__('t.add'), ['class'=>'w3-button w3-pink w3-margin-top']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @else
                    <h4><strong>{{ $data['shipping_charge']->currency_code.' '.$data['shipping_charge']->shipping_charge }}</strong></h4>
                    <button class="w3-button w3-blue sas-modal-button">{{ __('t.edit') }}</button>
                    <div id="sas-modal" class="w3-modal">
                        <div class="w3-modal-content w3-animate-top w3-padding">
                            <span class="w3-button w3-display-topright sas-modal-close-button">&times;</span>
                            <h3>{{__('t.edit_shpping_charge')}}</h3>
                            {!! Form::open(['url' => "/edit-shipping-charge", 'method' => 'POST', 'id' => 'edit_shiping_charge','files'=>true ]) !!}
                            {!! Form::label('shipping_charge', __('t.charge')) !!}
                            {!! Form::text('shipping_charge', $data['shipping_charge']->shipping_charge, ['class'=>'w3-input w3-border']) !!}
                            {!! Form::submit(__('t.update'), ['class'=>'w3-button w3-pink w3-margin-top']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection