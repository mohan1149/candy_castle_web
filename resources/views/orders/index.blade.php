@extends('layout.'.session()->get('role'))
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="w3-container">
        <div>
            <h4>{{ __('t.manage_orders') }}</h4>
        </div>    
        <div>
            <table class="w3-table" id="orders_list">
                <thead>
                    <tr>
                        <th>{{__('t.trasaction_number')}}</th>
                        <th>{{__('t.payment_method')}}</th>
                        <th>{{__('t.order_cost')}}</th>
                        <th>{{__('t.ordered_on')}}</th>
                        <th>{{__('t.status')}}</th>
                        <th>{{__('t.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr id="{{ $order->id }}">
                            <td> {{ $order->trasaction_number }} </td>
                            <td> {{ $order->payment_method }} </td>
                            <td> {{ $order->order_cost }} </td>
                            <td> {{ $order->created_at }} </td>
                            <td> 
                                <select 
                                    class="update_order_status w3-input w3-border" 
                                    order_id = {{ $order->id }}
                                    {{ $order->status == 3 ? "disabled" : ""}}
                                >
                                    <option {{ $order->status == 0 ? "selected" : ""}} value="0">{{ __('t.submitted') }}</option>
                                    <option {{ $order->status == 1 ? "selected" : ""}} value="1">{{ __('t.processing') }}</option>
                                    <option {{ $order->status == 2 ? "selected" : ""}} value="2">{{ __('t.shipped') }}</option>    
                                    <option {{ $order->status == 3 ? "selected" : ""}} value="3">{{ __('t.delivered') }}</option>
                                    <option {{ $order->status == 4 ? "selected" : ""}} value="4">{{ __('t.cancelled') }}</option>
                                </select>    
                            </td>
                            <td class="sas-actions-clm">
                                <a class="w3-margin-right" href="/orders/{{ $order->id }}/edit"><i class="fa-fw fas fa-edit w3-text-blue"></i></a>
                                <a href="/orders/{{ $order->id }}"><i class="fa-fw fas fa-eye w3-text-green"></i></a>
                                <a class="w3-margin-left delete-link"><i href="/orders/{{ $order->id }}" rid="{{ $order->id }}" class="fa-fw fas fa-trash w3-text-red"></i></a>
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
                let product_list = $('#orders_list').DataTable({
                    columnDefs: [
                        {
                            targets: 4,
                            orderable: false,
                            searchable: true,
                        },
                        {
                            targets: 5,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });
                $('.update_order_status').on('change',(e)=>{
                    let data = {
                        status : $(e.target).val(),
                        order : $(e.target).attr('order_id'),
                    };
                    $('.ajax_indicator').show();
                    $.ajax({
                        url:"/api/update-order",
                        method:"POST",
                        data: data,
                        success:(result)=>{
                            $('.ajax_indicator').hide();
                        },
                        error:(error)=>{
                            $('.ajax_indicator').hide();
                            $('.ajax_indicator_failed').show();
                        }
                    });
                });
            });
        </script>
    @endsection
@endsection