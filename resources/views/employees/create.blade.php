@extends('layout.'.session()->get('role'))
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "employees", 'method' => 'POST', 'id' => 'employee_add_form','files'=>true ]) !!}
            <div class="w3-row">
                <div class="w3-col l3">
                    <img id="image_view" src="{{ asset('sas') }}/images/svg/default_employee.svg" width="200px" style="padding: 25px">
                    <input type="file"  accept="image/*" name="employee_image" id="image_input" style="display: none;">
                    <label for="image_input" style="cursor: pointer;"><i class="fas fa-edit w3-text-blue w3-xlarge"></i></label>
                </div>
                <div class="w3-col l9">
                    <div class="w3-row">
                        <div class="w3-col l6">
                            <div class="w3-margin">
                                {{-- name --}}
                                {!! Form::label('name', __('t.name')) !!}
                                {!! Form::text('name', null, ['class'=>'w3-input w3-border','required']) !!}
                                {{-- civil_id --}}
                                {!! Form::label('civil_id', __('t.civil_id')) !!}
                                {!! Form::text('civil_id', null, ['class'=>'w3-input w3-border','required']) !!}
                                {{-- salons --}}
                                {!! Form::label('salon', __('t.salon')) !!}
                                {!! Form::select('salon', $salons, null, ['class'=>'w3-input w3-border']) !!}
                            </div>
                        </div>
                        <div class="w3-col l6">
                            <div class="w3-margin">
                                {{-- phone --}}
                                {!! Form::label('phone', __('t.phone')) !!}
                                {!! Form::text('phone', null, ['class'=>'w3-input w3-border','required']) !!}
                                {{-- email --}}
                                {!! Form::label('email', __('t.email')) !!}
                                {!! Form::email('email', null, ['class'=>'w3-input w3-border']) !!}
                                {{-- password --}}
                                {!! Form::label('password', __('t.password')) !!}
                                {!! Form::text('password', null, ['class'=>'w3-input w3-border','disabled','placeholder'=>__('t.same_as_civil')]) !!}
                            </div>
                        </div>
                        <div class="w3-col l12">
                            <div class="w3-margin">
                                {{-- expert_in --}}
                                {!! Form::label('expert_in', __('t.expert_in')) !!}
                                {!! Form::select('expert_in[]', $services, null, ['class'=>'w3-input w3-border expert_multi_select','multiple'=>'multiple','required']) !!}
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="w3-col l12">
                    {{-- address --}}
                    <label for="address">{{ __('t.address')}}</label>
                    <textarea required class="w3-input w3-border" name="address" id="address" cols="30" rows="5"></textarea>
                </div>                
            </div>
            <input class="w3-pink w3-margin-top w3-button w3-blue" type="submit" value="{{__('t.add')}}">
        {!! Form::close() !!}
    </div>
    @section('javascript')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(()=>{
                $('.expert_multi_select').select2();
            });
        </script>
        @endsection
@endsection
