<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Mail;
use Session;
use App\Mail\SentCustomer;
use App\Shipping;
use App\Order;
use App\OrderDetail;
use Cart;

class CheckoutController extends Controller
{
    public function customer_form_view(){

    	return view('frontend.checkout.customer_form');
    }

    public function customer_signup_info(Request $request){

        $request->validate([
            'email_address'=>'required|unique:customers,email_address'
        ]);

    	$customer = new Customer();

    	$customer->first_name = $request->first_name;
    	$customer->last_name = $request->last_name;
    	$customer->email_address = $request->email_address; 
    	$customer->phone_number = $request->phone_number;
    	$customer->password = bcrypt($request->password);
    	$customer->address = $request->address;

    	$customer->save();

    	Session::put(['customer_id'=>$customer->id]);
    	Session::put(['customer_full_name'=>$customer->first_name.' '.$customer->last_name]);

    	Mail::to($customer->email_address)->send(new SentCustomer($customer));

    	return redirect('/checkout/shipping');
    }

    public function shipping_form_view(){

    	$customer = Customer::find(Session::get('customer_id'));
    	return view('frontend.checkout.shipping_form',['customer'=>$customer]);
    }


    public function shipping_info_save(Request $request){
    	

    	$shipping=new Shipping();

    	$shipping->full_name = $request->full_name;
    	$shipping->email_address = $request->email_address; 
    	$shipping->phone_number = $request->phone_number;
    	$shipping->address = $request->address;
    	$shipping->save();

    	Session::put(['shipping_id'=>$shipping->id]);


    	return redirect('/checkout/payment');
    }



    public function payment_form_view(){

    	return view('frontend.checkout.payment_form');
    	
    }


    public function order_info_save(Request $request){

    	// return $request->payment_type;

    	if($request->payment_type == 'Cash') {
    		
    		$order=new Order();

    		$order->customer_id = Session::get('customer_id');
    		$order->shipping_id = Session::get('shipping_id');
    		$order->total_price = Session::get('getSubTotal');
    		$order->payment_type = $request->payment_type;

    		$order->save();

    		// return $order->id;

    		$cartContents = Cart::getContent();

    		foreach ($cartContents as $cartContent) {
    			
    			$order_detail=new OrderDetail();

	    		$order_detail->order_id= $order->id;
	    		$order_detail->product_id= $cartContent->id;
	    		$order_detail->product_name= $cartContent->name;
	    		$order_detail->product_image= $cartContent->attributes->product_image;
	    		$order_detail->product_price= $cartContent->price;
	    		$order_detail->product_quantity= $cartContent->quantity;
	    		
	    		$order_detail->save();

    		}

    		Cart::clear();

    		return redirect('/');

    	}elseif($request->payment_type == 'Paypal'){

    		
    	}elseif($request->payment_type == 'Bkash'){

    	}
    }


    public function logout_customer(){

        session()->forget(['customer_id','customer_full_name','shipping_id']);

        return redirect('/');
    }






}
