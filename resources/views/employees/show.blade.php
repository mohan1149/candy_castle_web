@extends('layout.'.session()->get('role'))
@section('content')
    <div class="w3-container">
        <div class="w3-row">
            <div class="w3-col l4">
                <div class="w3-padding">
                    <img src="{{ $employee->profile_picture }}" alt="" width="200px" height="200px">
                </div>
            </div>
            <div class="w3-col l8">
                <div class="w3-padding">
                    <ul class="w3-ul">
                        <li>{{ $employee->name }}</li>
                        <li>{{ $employee->phone }}</li>
                        <li>{{ $employee->civil_id }}</li>
                        <li>{{ $employee->email }}</li>
                        <li>{{ $employee->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection