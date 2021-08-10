@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        {!! Form::open(['url' => "service-categories", 'method' => 'POST', 'id' => 'salon_category_add_form' ]) !!}
            {{-- name --}}
            {!! Form::label('name', __('t.name')) !!}
            {!! Form::text('name', null, ['class'=>'w3-input w3-border','required']) !!}
            {{-- salon --}}
            {!! Form::label('salon', __("t.salon")) !!}
            {!! Form::select('salon', $salon, null, ['class'=>'w3-input w3-border','required']) !!}
            {{-- description --}}
            {!! Form::label('description', __("t.description")) !!}
            {!! Form::textarea('description', null, ['class'=>'w3-input w3-border']) !!}
            {!! Form::submit(__("t.add_category"), ['class'=>'w3-button w3-pink w3-margin-top']) !!}
        {!! Form::close() !!}
    </div>
@endsection
