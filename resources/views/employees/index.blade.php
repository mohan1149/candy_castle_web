@extends('layout.'.session()->get('role'))
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{__('t.manage_employees') }}. <a href="/employees/create"><i class=" w3-text-blue fas fa-plus-circle"></i></a></h4>
        </div>    
        <div>
            <table class="w3-table w3-centered" id="employees_list">
                <thead>
                    <tr>
                        <th>{{__('t.image')}}</th>
                        <th>{{__('t.name')}}</th>
                        <th>{{__('t.civil_id')}}</th>
                        <th>{{__('t.phone')}}</th>
                        <th>{{__('t.email')}}</th>
                        <th>{{__('t.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr id="{{ $employee->id }}">
                            <td> <img src="{{ $employee->profile_picture }}" class="sas_thumbnail" alt=""> </td>
                            <td> {{ $employee->name }} </td>
                            <td> {{ $employee->civil_id }} </td>
                            <td> {{ $employee->phone }} </td>
                            <td> {{ $employee->email }} </td>
                            <td class="sas-actions-clm">
                                <a class="w3-margin-right" href="/employees/{{ $employee->id }}/edit"><i class="fa-fw fas fa-edit w3-text-blue"></i></a>
                                <a href="/employees/{{ $employee->id }}"><i class="fa-fw fas fa-eye w3-text-green"></i></a>
                                <a class="w3-margin-left delete-link"><i href="/employees/{{ $employee->id }}" rid="{{ $employee->id }}" class="fa-fw fas fa-trash w3-text-red"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @section('javascript')
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                let product_list = $('#employees_list').DataTable({
                    columnDefs: [
                        {
                            targets: 5,
                            orderable: false,
                            searchable: false,
                        },
                        {
                            targets: 0,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });
            });
        </script>
    @endsection
@endsection