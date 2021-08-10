@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "service-categories/$serviceCategory->id", 'method' => 'PUT', 'id' => 'salon_category_edit_form' ]) !!}
            {{-- name --}}
            {!! Form::label('name', __('t.name')) !!}
            {!! Form::text('name', $serviceCategory->name, ['class'=>'w3-input w3-border','required']) !!}
            {{-- salon --}}
            {!! Form::label('salon', __("t.salon")) !!}
            {!! Form::select('salon', $salon, $serviceCategory->salon_id, ['class'=>'w3-input w3-border','required']) !!}
            {{-- description --}}
            {!! Form::label('description', __("t.description")) !!}
            {!! Form::textarea('description', $serviceCategory->description, ['class'=>'w3-input w3-border']) !!}
            {!! Form::submit(__("t.update_category"), ['class'=>'w3-button w3-pink w3-margin-top']) !!}
        {!! Form::close() !!}
    </div>
@endsection
