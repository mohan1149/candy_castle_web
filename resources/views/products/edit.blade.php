@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "products/$product->id", 'method' => 'PUT', 'id' => 'product_add_form','files'=>true ]) !!}
            <div class="w3-row">
                <div class="w3-col l3">
                    <img id="image_view" src="{{ $product->image }}" width="200px" style="padding: 25px">
                    <input type="file"  accept="image/*" name="product_image" id="image_input" style="display: none;">
                    <label for="image_input" style="cursor: pointer;"><i class="fas fa-edit w3-text-blue w3-xlarge"></i></label>
                </div>
                <div class="w3-col l9">
                    {{-- name --}}
                    <label for="name">{{__("t.name")}}</label>
                    <input value="{{ $product->name }}" required type="text" class="w3-input w3-border" name="name" id="name">
                    {{-- sku --}}
                    <label for="sku">{{__("t.product_sku")}}</label>
                    <input value="{{ $product->sku }}" required type="text" class="w3-input w3-border" name="sku" id="sku">
                    {{-- category --}}
                    {!! Form::label('category', __('t.category_name')) !!}
                    {!! Form::select('category', $categories,$product->category_id,['class'=>'w3-input w3-border']) !!}
                    <div class="w3-half">
                        <div class="w3-margin-right">
                            {{-- stock --}}
                            <label for="stock">{{ __('t.product_stock_quantity') }}</label>
                            <input value="{{ $product->stock_quantity }}" required type="number" class="w3-input w3-border" name="stock" id="stock">
                            {{-- purchase_price --}}
                            <label for="purchase_price">{{__('t.product_purchase_price')}}</label>
                            <input value="{{ $product->purchase_price }}" type="text" class="w3-input w3-border" name="purchase_price" id="purchase_price">
                        </div>
                    </div>
                    <div class="w3-half">
                        <div class="w3-margin-left">
                            {{-- weight --}}
                            <label for="weight">{{__("t.weight")}} (.gms)</label>
                            <input value="{{ $product->weight }}" value="0" type="text" class="w3-input w3-border" name="weight" id="weight">
                            {{-- selling_price --}}
                            <label for="selling_price">{{__('t.product_selling_price')}}</label>
                            <input value="{{ $product->selling_price }}" required type="text" class="w3-input w3-border" name="selling_price" id="selling_price">
                        </div>
                    </div>
                </div>
                <div class="w3-col l12">
                    {{-- description --}}
                    <label for="description">{{__("t.description")}}</label>
                    <textarea required class="w3-input w3-border" name="description" id="description" cols="30" rows="5">{{ $product->description }}</textarea>
                </div>    
                <input class="w3-pink w3-margin-top w3-button w3-blue" type="submit" value="{{__('t.update')}}">            
            </div>
        {!! Form::close() !!}
    </div>
@endsection