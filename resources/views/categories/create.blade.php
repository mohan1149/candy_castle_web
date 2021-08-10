@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "categories", 'method' => 'POST', 'id' => 'category_add_form','files'=>true ]) !!}
            <div class="w3-row">
                <div class="w3-col l3">
                    <img id="image_view" src="{{ asset('cc') }}/images/svg/default_category.svg" width="200px" style="padding: 25px">
                    <input type="file"  accept="image/*" name="category_image" id="image_input" style="display: none;">
                    <label for="image_input" style="cursor: pointer;"><i class="fas fa-edit w3-text-blue w3-xlarge"></i></label>
                </div>
                <div class="w3-col l9">
                    {{-- name --}}
                    <label for="name">{{ __('t.name') }}</label>
                    <input required type="text" class="w3-input w3-border" name="name" id="name">

                    {{-- description --}}
                    <label for="description">{{__('t.description')}}</label>
                    <textarea required class="w3-input w3-border" name="description" id="description" cols="30" rows="5"></textarea>
                </div>             
            </div>
            <input class="w3-pink w3-margin-top w3-button w3-blue" type="submit" value="{{__('t.add')}}">
        {!! Form::close() !!}
    </div>
@endsection
