<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function product_form_show(){

    	$categories = DB::table('categories')->where('publication_status',1)->get();
    	return view('admin.product.product_form', ['categories'=>$categories]);
    }


    public function productSave(Request $request){

    	// return $request->all();
    	$validatedData = $request->validate([
        'product_name' => 'required',
        'category_id' => 'required',
        'product_short_description' => 'required',
        'product_detail_description' => 'required',
        'product_price' => 'required|integer',
        'publication_status' => 'required',
    	]);

    	$present_id = DB::table('products')->insertGetId([

    		'product_name'=>$request->product_name,
    		'category_id'=>$request->category_id,
    		'product_short_description'=>$request->product_short_description,
    		'product_detail_description'=>$request->product_detail_description,
    		'product_price'=>$request->product_price,
    		'publication_status'=>$request->publication_status,
        'created_at'=>Carbon::now(),
    	]);

		if ($request->hasFile('product_image'))
		{
		    	$file_name = $present_id.'.'.$request->product_image->getClientOriginalExtension();
		    	Image::make($request->product_image)->save(base_path('public/uploads/product_images/'.$file_name));
		    	DB::table('products')
		    		->where('id', $present_id)
		    		->update([
		    			'product_image' => $file_name,
		    		]);

		    	}

    	return back()->with('product_add_msg','Product added successfully!');
    }



   public function product_manage_view(){

   	$products =Product::orderBy('id', 'DESC')->paginate(5);
   	return view('admin.product.product_manage',['products'=>$products]);
   }


	 public function delete_product_manage_view(){

	   	$softDeleteProducts =Product::onlyTrashed()->paginate(3);
	   	return view('admin.product.DeleteProducts_manage',['softDeleteProducts'=>$softDeleteProducts]);
	   }

	public function restore_product_by_id($id){

	   Product::withTrashed()->where('id', $id)->restore();
	   return back()->with('publish_status_msg','Product Restore successfully!');
	   	
	   }


	 public function force_delete_product_by_id($id){

	 	$product =Product::onlyTrashed()->find($id);

	 	if ($product->product_image == 'default_image.jpg') {
	 		
	 		Product::onlyTrashed()->where('id', $id)->forceDelete();
	   		return back()->with('product_delete_msg','Product permanently deleted successfully!');

	 	}else{

	 		unlink(base_path('public/uploads/product_images/'.$product->product_image));
	  		Product::onlyTrashed()->where('id', $id)->forceDelete();
	   		return back()->with('product_delete_msg','Product permanently deleted successfully!');

		}
	   	
	   }


   public function unpublish_product_by_id($id){

   		DB::table('products')
              ->where('id', $id)
              ->update(['publication_status' => 0]);

         return back()->with('unpublish_status_msg','Product unpublished successfully!');
   }


     public function publish_product_by_id($id){

   		DB::table('products')
              ->where('id', $id)
              ->update(['publication_status' => 1]);

         return back()->with('publish_status_msg','Product published successfully!');
   }


   public function delete_product_by_id($id){

   		// DB::table('products')->where('id', $id)->delete();
   		Product::where('id',$id)->delete();
   		return back()->with('product_delete_msg','Product deleted successfully!');
   }



   public function edit_product_by_id($id){

   		$categories = DB::table('categories')->where('publication_status',1)->get();
   		$product = DB::table('products')->where('id', $id)->first();
   		return view('admin.product.edit_product_form',['categories'=>$categories,'product'=>$product]);
   		return back()->with('product_edit_msg','Product updated successfully');

   }


   public function product_update(Request $request){

   		$validatedData = $request->validate([
        'product_name' => 'required',
        'category_id' => 'required',
        'product_short_description' => 'required',
        'product_detail_description' => 'required',
        'product_price' => 'required|integer',
        'publication_status' => 'required',
    	]);

    	DB::table('products')->where('id',$request->product_id)->update([

    		'product_name'=>$request->product_name,
    		'category_id'=>$request->category_id,
    		'product_short_description'=>$request->product_short_description,
    		'product_detail_description'=>$request->product_detail_description,
    		'product_price'=>$request->product_price,
    		'publication_status'=>$request->publication_status,
    	]);

    	if ($request->hasFile('product_image'))
		{		
				$product = Product::find($request->product_id);

				if ($product->product_image == 'default_image.jpg') {
					
					$file_name = $request->product_id.'.'.$request->product_image->getClientOriginalExtension();
			    	Image::make($request->product_image)->save(base_path('public/uploads/product_images/'.$file_name));
			    	DB::table('products')
			    		->where('id', $request->product_id)
			    		->update([
			    			'product_image' => $file_name,
			    		]);
				}else{

					unlink(base_path('public/uploads/product_images/'.$product->product_image));
					$file_name = $request->product_id.'.'.$request->product_image->getClientOriginalExtension();
			    	Image::make($request->product_image)->save(base_path('public/uploads/product_images/'.$file_name));
			    	DB::table('products')
			    		->where('id', $request->product_id)
			    		->update([
			    			'product_image' => $file_name,
			    		]);
				}

				}

    	return back()->with('product_update_msg','Product updated successfully!');

   }



}
