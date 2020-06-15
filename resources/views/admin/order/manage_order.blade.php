@extends('admin.dashboard')


@section('title')
Manage Order
@endsection

@section('dashboard_body')




<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered ">
                <thead class="thead-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name </th>
                        <th>Total Price</th>
                        <th>Payment Type </th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Order Date </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->orderRelationTocustomer->first_name.' '.$order->orderRelationTocustomer->last_name}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>{{$order->payment_type}}</td>
                            <td>{{$order->order_status}}</td>
                            <td>{{$order->payment_status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{route('order_view',$order->id)}}" title="view Order details"><i class="fas fa-info"></i></a>
                                    <a class="btn btn-success" href="{{route('order_invoice',$order->id)}}" title="view Order Invoice"><i class="fas fa-file-invoice"></i></a>
                                    <a class="btn btn-primary" href="{{route('order_invoice_download',$order->id)}}" title="Order Invoice Download"><i class="fas fa-file-download"></i></a>
                                    <a class="btn btn-danger" href="" title=" Order Delete"><i class="fas fa-trash-alt"></i></a>
                                    <a class="btn btn-warning" href="" title=" Order Edit"><i class="far fa-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach             
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection