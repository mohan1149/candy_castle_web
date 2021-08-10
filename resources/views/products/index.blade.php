@extends('layout.'.session()->get('role'))
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{ __('t.manage_products') }} <a href="/products/create"><i class=" w3-text-blue fas fa-plus-circle"></i></a></h4>
        </div>    
        <div>
            <table class="w3-table w3-centered" id="product_list">
                <thead>
                    <tr>
                        <th>{{__('t.product_image')}}</th>
                        <th>{{__('t.product_sku')}}</th>
                        <th>{{__('t.product_name')}}</th>
                        <th>{{__('t.category_name')}}</th>
                        <th>{{__('t.product_purchase_price')}}</th>
                        <th>{{__('t.product_selling_price')}}</th>
                        <th>{{__('t.product_stock_quantity')}}</th>
                        <th>{{__('t.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr id="{{ $product->id }}">
                            <td> <img src="{{ $product->image }}" class="sas_thumbnail" alt=""> </td>
                            <td> {{ $product->sku }} </td>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->category }} </td>
                            <td> {{ $product->purchase_price }} </td>
                            <td> {{ $product->selling_price }} </td>
                            <td> {{ $product->stock_quantity }} </td>
                            <td class="sas-actions-clm">

                                <a class="w3-margin-right" href="/products/{{ $product->id }}/edit"><i class="fa-fw fas fa-edit w3-text-blue"></i></a>
                                <a href="/products/{{ $product->id }}"><i class="fa-fw fas fa-eye w3-text-green"></i></a>
                                <a class="w3-margin-left delete-link"><i href="/products/{{ $product->id }}" rid="{{ $product->id }}" class="fa-fw fas fa-trash w3-text-red"></i></a>
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
                let product_list = $('#product_list').DataTable({
                    columnDefs: [
                        {
                            targets: 7,
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