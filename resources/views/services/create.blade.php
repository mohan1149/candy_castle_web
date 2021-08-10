@extends('layout.'.session()->get('role'))
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "services", 'method' => 'POST', 'id' => 'service_add_form','files'=>true ]) !!}
            <div class="w3-row">
                <div class="w3-col l3">
                    <img id="image_view" src="{{ asset('sas') }}/images/svg/default_salon.svg" width="200px" style="padding: 25px">
                    <input type="file"  accept="image/*" name="service_image" id="image_input" style="display: none;">
                    <label for="image_input" style="cursor: pointer;"><i class="fas fa-edit w3-text-blue w3-xlarge"></i></label>
                </div>
                <div class="w3-col l9">
                    {{-- name --}}
                    <label for="name">name</label>
                    <input required type="text" class="w3-input w3-border" name="name" id="name">
                    {{-- charge --}}
                    <label for="charge">charge</label>
                    <input type="text" class="w3-input w3-border" name="charge" id="charge">
                    {{-- duration --}}
                    <label for="duration">duration [.mins]</label>
                    <input type="number" class="w3-input w3-border" name="duration" id="duration">
                    {{-- service_category --}}
                    <label for="service_category">{{__("t.service_category")}}</label>
                    {!! Form::select('service_category', $services_categories, null, ['class'=>'w3-input w3-border']) !!}
                    {{-- salons --}}
                    <label for="salons">salons</label>
                    {!! Form::select('salons[]', $salons,null, ['class'=>'salon_multi_select w3-input w3-border','multiple']) !!}
                    
                </div>
                <div class="w3-col l12">
                    {{-- description --}}
                    <label for="description">description</label>
                    <textarea required class="w3-input w3-border" name="description" id="description" cols="30" rows="5"></textarea>
                </div>                
            </div>
            <input class="w3-pink w3-margin-top w3-button w3-blue" type="submit" value="{{__('add')}}">
        {!! Form::close() !!}
    </div>
    @section('javascript')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(()=>{
                $('.salon_multi_select').select2();
            });
        </script>
    @endsection
@endsection
