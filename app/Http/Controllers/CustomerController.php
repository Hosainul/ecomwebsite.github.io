<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Session;

class CustomerController extends Controller
{
    
    public function customer_login_check(Request $request){

    	$customer = Customer::where('email_address',$request->email_address)->first();

    	if (Customer::where('email_address',$request->email_address)->first()) {
    		if (password_verify($request->password, $customer->password)) {
    			Session::put(['customer_id'=>$customer->id]);
    			Session::put(['customer_full_name'=>$customer->first_name.' '.$customer->last_name]);
    			return redirect()->route('shipping_form');
    		}else{
    			return redirect('/checkout/customer')->with('wrong_info','Your email or password in invalid');
    		}
    	}else{
    		return redirect('/checkout/customer')->with('wrong_info','Your email or password in invalid');
    	}

    }
}
