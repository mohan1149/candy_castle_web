@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        {{ $error['msg'] }}
    </div>    
@endsection