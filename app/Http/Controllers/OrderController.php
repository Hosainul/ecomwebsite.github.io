<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Shipping;
use App\OrderDetail;
use PDF;

class OrderController extends Controller
{
    public function order_manage_view(){

    	$orders = Order::all();

    	return view('admin.order.manage_order',compact('orders'));
    }


    public function order_view_by_order_id($order_id){

    	$order = Order::find($order_id);
    	$customer = Customer::find($order->customer_id);
    	$shipping = Shipping::find($order->shipping_id);
    	$orderDetails = OrderDetail::where('order_id',$order_id)->get();
    	return view('admin.order.order_details',compact('shipping','order','customer','orderDetails'));
    }


    public function order_invoice_by_order_id($order_id){

    	$order = Order::find($order_id);
    	$customer = Customer::find($order->customer_id);
    	$shipping = Shipping::find($order->shipping_id);
    	$order_details = OrderDetail::where('order_id',$order_id)->get();
    	return view('admin.order.order_invoice',compact('shipping','order','customer','order_details'));
    }


    public function order_invoice_download_by_order_id($order_id){

    	$order = Order::find($order_id);
    	$customer = Customer::find($order->customer_id);
    	$shipping = Shipping::find($order->shipping_id);
    	$order_details = OrderDetail::where('order_id',$order_id)->get();
    	
    	$pdf = PDF::loadView('admin.order.order_invoice_download',compact('shipping','order','customer','order_details'));  
        return $pdf->download($customer->first_name.' '.$customer->last_name.' '.$order->id);
    }


}
