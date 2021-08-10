@extends('layout.'.session()->get('role'))
@section('css')
    <link rel="stylesheet" href="{{ asset('cc') }}/css/timepicker.css">
@endsection
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "salons/$salon->id", 'method' => 'PUT', 'id' => 'salon_edit_form','files'=>true ]) !!}
            <div class="w3-row">
                <div class="w3-col l3">
                    <img id="image_view" src="{{ $salon->thumbnail }}" width="200px" style="padding: 25px">
                    <input type="file"  accept="image/*" name="salon_image" id="image_input" style="display: none;">
                    <label for="image_input" style="cursor: pointer;"><i class="fas fa-edit w3-text-blue w3-xlarge"></i></label>
                </div>
                <div class="w3-col l9">
                    {{-- name --}}
                    {!! Form::label('name', __('t.name')) !!}
                    {!! Form::text('name', $salon->name, ['class'=>'w3-input w3-border','required']) !!}
                    {{-- phone --}}
                    {!! Form::label('phone', __('t.phone')) !!}
                    {!! Form::text('phone', $salon->phone, ['class'=>'w3-input w3-border','required']) !!}
                    {{-- opening --}}
                    {!! Form::label('opening', __('t.opening_time')) !!}
                    {!! Form::text('opening', $salon->opening, ['class'=>'w3-input w3-border opening','required']) !!}
                    {{-- closing --}}
                    {!! Form::label('closing', __('t.closing_time')) !!}
                    {!! Form::text('closing', $salon->closing, ['class'=>'w3-input w3-border closing','required']) !!}
                </div>
                <div class="w3-col l12">
                    {{-- address --}}
                    <label for="address">{{__("t.address")}}</label>
                    <textarea required class="w3-input w3-border" name="address" id="address" cols="30" rows="5">{{ $salon->address }}</textarea>
                </div>                
            </div>
            <input class="w3-pink w3-margin-top w3-button w3-blue" type="submit" value="{{__('t.update')}}">
        {!! Form::close() !!}
    </div>
    @section('javascript')
        <script src="{{ asset('cc') }}/js/timepicker.js"></script>
        <script>
            $('.opening').mdtimepicker();
            $('.closing').mdtimepicker();
        </script>
    @endsection
@endsection
