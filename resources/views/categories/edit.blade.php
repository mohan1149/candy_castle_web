@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "categories/$input->id", 'method' => 'PUT', 'id' => 'category_edit_form','files'=>true ]) !!}
            <div class="w3-row">
                <div class="w3-col l3">
                    <img id="image_view" src="{{ $input->thumbnail }}" width="200px" style="padding: 25px">
                    <input type="file"  accept="image/*" name="category_image" id="image_input" style="display: none;">
                    <label for="image_input" style="cursor: pointer;"><i class="fas fa-edit w3-text-blue w3-xlarge"></i></label>
                </div>
                <div class="w3-col l9">
                    {{-- name --}}
                    <label for="name">{{__('t.name')}}</label>
                    <input value="{{ $input->name }}" required type="text" class="w3-input w3-border" name="name" id="name">
                    {{-- description --}}
                    <label for="description">{{__('t.description')}}</label>
                    <textarea required class="w3-input w3-border" name="description" id="description" cols="30" rows="5">{{ $input->description }}</textarea>
                </div>             
            </div>
            <input class="w3-pink w3-margin-top w3-button w3-blue" type="submit" value="{{__('t.update')}}">
        {!! Form::close() !!}
    </div>
@endsection
