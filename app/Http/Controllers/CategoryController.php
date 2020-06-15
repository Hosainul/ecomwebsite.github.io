<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;


class CategoryController extends Controller
{
    public function category_form()
    {
    	return view('admin.category.category_add_form');
    }

    public function category_save(Request $request)
    {
    	// return $request->all();

    	$validatedData = $request->validate([
        'category_name' => 'required|unique:categories,category_name',
        'category_description' => 'required',
        'publication_status' => 'required',
    	]);

    	$category = new Category;
    	$category->category_name = $request->category_name;
    	$category->category_description = $request->category_description;
    	$category->publication_status = $request->publication_status;

    	$category->save();

    	return redirect('category/form')->with('Category_add_msg','Category added successfully!');
    }


    public function manage_category(){

    	$categories = Category::paginate(5);
    	return view('admin.category.category_manage',['categories'=>$categories]);
    }

    public function unpublish_category($id)
    {

    	$category = Category::find($id);
    	$category->publication_status= 0;
    	$category->save();
    	return back()->with('unpublish_status_message','Category unpublish successfully!');
    }


    public function publish_category_by_id($id)
    {

    	$category = Category::find($id);
    	$category->publication_status= 1;
    	$category->save();
    	return back()->with('publish_status_message','Category publish successfully!');
    }

     public function category_delete($id)
    {

   		$category = Category::find($id);
    	$category->delete();
    	return back()->with('category_delete_message','Category deleted successfully!');
    }

     public function edit_category($id)
    {

   		$category = Category::find($id);
    	return view('admin.category.category_edit_form',['category'=>$category]);
    	return back()->with('Category_edit_msg','Category edited successfully!');
    }

      public function category_update(Request $request)
    {
    	// return $request->all();

    	$validatedData = $request->validate([
        'category_name' => 'required',
        'category_description' => 'required',
        'publication_status' => 'required',
    	]);

    	$category = Category::find($request->category_id);
    	$category->category_name = $request->category_name;
    	$category->category_description = $request->category_description;
    	$category->publication_status = $request->publication_status;
   		$category->save();
    	return back()->with('Category_update_msg','Category updated successfully!');
    }
    	

}
