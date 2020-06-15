<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class FrontendController extends Controller
{
    
    public function index(){

    	$latest_products = Product::where('publication_status',1)->orderby('id', 'DESC')->take(8)->get();
    	$all_products = Product::where('publication_status',1)->orderby('id', 'DESC')->get();
    	// $all_categories = Category::where('publication_status',1)->get();
    	return view('frontend.index_content',['latest_products'=>$latest_products,'all_products'=>$all_products]);
    }


    public function product_details_view($product_id){

    	$product_details = Product::find($product_id);
    	$related_products = Product::where('category_id', $product_details->category_id)->where('publication_status',1)->where('id','!=', $product_details->id)->get();
    	return view('frontend/product_details',['product_details'=>$product_details, 'related_products'=>$related_products]);
    }


    public function shop_product_view(){

        $all_products = Product::where('publication_status',1)->orderby('id', 'DESC')->paginate(12);
        // $all_categories = Category::where('publication_status',1)->get();
        return view('frontend.shop_page',['all_products'=>$all_products]);
    }


    public function show_category_products_by_cat_id($id){

        // $all_categories = Category::where('publication_status',1)->get();
        $category_products = Product::where('publication_status',1)->where('category_id',$id)->paginate(3);
        return view('frontend.shop_page',['all_products'=>$category_products]);
    }
    
}
