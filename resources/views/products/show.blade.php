@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col l4">
                <div class="w3-padding">
                    <img src="{{ $product->image }}" alt="" width="200px" height="200px">
                </div>
            </div>
            <div class="w3-col l8">
                <div class="w3-padding">
                    <ul class="w3-ul">
                        <li>{{ $product->name }}</li>
                        <li>{{ $product->sku }}</li>
                        <li>{{ $product->description }}</li>
                        <li>{{ __('t.product_selling_price').'# '.$product->selling_price }}</li>
                        <li>{{ __('t.product_stock_quantity').'# '.$product->stock_quantity }}</li>
                        <li>{{ __('t.product_purchase_price').'# '.$product->purchase_price }}</li>
                        <li>{{ __('t.weight').'# '.$product->weight }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection