@extends('layout.'.session()->get('role'))
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{__('t.service_categories') }}. <a href="/service-categories/create"><i class=" w3-text-blue fas fa-plus-circle"></i></a></h4>
        </div>    
        <div>
            <table class="w3-table w3-centered" id="serviceCategories_list">
                <thead>
                    <tr>
                        <th>{{__('t.name')}}</th>
                        <th>{{__('t.description')}}</th>
                        <th>{{__('t.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceCategories as $serviceCategory)
                        <tr id="{{ $serviceCategory->id }}">
                            <td> {{ $serviceCategory->name }} </td>
                            <td> {{ $serviceCategory->description }} </td>
                            <td class="sas-actions-clm">
                                <a class="w3-margin-right" href="/service-categories/{{ $serviceCategory->id }}/edit"><i class="fa-fw fas fa-edit w3-text-blue"></i></a>
                                <a class="delete-link"><i href="/service-categories/{{ $serviceCategory->id }}" rid="{{ $serviceCategory->id }}"  class="fa-fw fas fa-trash w3-text-red"></i></a>
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
                let product_list = $('#serviceCategories_list').DataTable({
                    columnDefs: [
                        {
                            targets: 2,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });
            });
        </script>
    @endsection
@endsection