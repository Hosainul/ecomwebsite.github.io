<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;

class CartController extends Controller
{
   public function product_add_to_cart(Request $request){

   	// return $request->product_id;
   	$product = Product::find($request->product_id);

   		Cart::add([
			    'id' => $product->id,
			    'name' => $product->product_name,
			    'price' => $product->product_price,
			    'quantity' => $request->product_quantity,
			    'attributes' => [
			    		'product_image' => $product->product_image,
			    	]
			]);

   		return redirect()->route('show_category_products',$product->category_id);
   		// return Cart::getContent();
   }


   public function cart_item_remove_product_by_id($id){

   		Cart::remove($id);

   		return back();
   }

   public function cart_item_update_product_by_id(Request $request){

   		Cart::update($request->product_id, array(
   			'quantity' => array(
   				'relative' => false,
		  		'value' => $request->product_quantity,
		),
		));

		return back();
   }
}
