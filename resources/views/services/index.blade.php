@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{ __('t.manage_services')}}<a href="/services/create"> <i class=" w3-text-blue fas fa-plus-circle"></i></a></h4>
        </div>
        <div class="w3-row">
            @foreach ($services as $service)
            <div class="w3-col l3" id="{{ $service->id }}">
                <div class="w3-margin w3-border w3-round w3-padding">
                    <a href="/services/{{ $service->id }}/edit"><i class="fa-fw fas fa-edit w3-text-blue"></i>  {{ __('t.edit') }}</a>
                    <a rid="{{ $service->id }}" class="w3-right delete-link" href="/services/{{ $service->id }}"><i class="fa-fw fas fa-trash w3-text-red"></i>  {{ __('t.delete') }}</a>
                    <img src="{{ $service->thumbnail }}" style="display: block;margin:0 auto;" width="150px" height="150px">
                    <div>
                        <h3 class="w3-center">{{ $service->name}}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection