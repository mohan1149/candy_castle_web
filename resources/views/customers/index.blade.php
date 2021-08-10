@extends('layout.'.session()->get('role'))
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{ __('t.manage_customers') }}</h4>
        </div>    
        <div>
            <table class="w3-table" id="customer_list">
                <thead>
                    <tr>
                        <th>{{__('t.name')}}</th>
                        <th>{{__('t.phone')}}</th>
                        {{-- <th>{{__('t.order_cost')}}</th>
                        <th>{{__('t.created_at')}}</th>
                        <th>{{__('t.status')}}</th>
                        <th>{{__('t.actions')}}</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td> {{ $customer->name }} </td>
                            <td> {{ $customer->phone }} </td>
                            {{-- <td> {{ $order->order_cost }} </td>
                            <td> {{ $order->created_at }} </td>
                            <td> {{ $order->status }} </td>
                            <td class="sas-actions-clm">
                                <a class="sas-icon-btn" href="/products/{{ $order->id }}/edit"><i class="w3-large w3-text-blue fas fa-edit"></i></a>
                                <a class="sas-icon-btn" href="/products/{{ $order->id }}"><i class="w3-large w3-text-green fas fa-eye"></i></a>
                                <a class="sas-icon-btn" data-href="/products/delete/{{ $order->id }}"><i class="w3-large w3-text-red fas fa-trash"></i></a>
                            </td> --}}
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
                let product_list = $('#customer_list').DataTable({
                });
            });
        </script>
    @endsection
@endsection