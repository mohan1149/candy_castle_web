@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{__('t.manage_salons')}}. <a href="/salons/create"><i class=" w3-text-blue fas fa-plus-circle"></i></a></h4>
        </div>
        <div class="w3-row">
            @foreach ($salons as $salon)
            <div class="w3-col l4" id="{{ $salon->id }}">
                <div class="w3-margin w3-border w3-round w3-padding">
                    <a href="/salons/{{ $salon->id }}/edit"><i class="fa-fw fas fa-edit w3-text-blue"></i>  {{ __('t.edit') }}</a>
                    <a rid="{{ $salon->id }}" class="w3-right delete-link" href="/salons/{{ $salon->id }}"><i class="fa-fw fas fa-trash w3-text-red"></i>  {{ __('t.delete') }}</a>
                    <img src="{{ $salon->thumbnail }}" style="display: block;margin:0 auto;" width="70%" height="208px">
                    <div>
                        <h3 class="w3-center">{{ $salon->name}}</h3>
                        <p><i class="fa-fw fas fa-phone w3-text-pink"></i>  {{ $salon->phone }}</p>
                        <p><i class="fa-fw fas fa-clock w3-text-pink"></i>  {{ $salon->opening ." - ".$salon->closing }}</p>
                        <p><i class="fa-fw fas fa-map-marker-alt w3-text-pink"></i>  {{ $salon->address }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection