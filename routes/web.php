<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontendController@index');


//dashboard

Route::get('/category/form','CategoryController@category_form')->name('category_form');

Route::post('/category/form','CategoryController@category_save')->name('category_save');

Route::get('/category/manage',
		[	
			'uses'=>'CategoryController@manage_category',
			'as'  =>'manage_category'
		]);

Route::get('/category/unpublished/{id}',
		[	
			'uses'=>'CategoryController@unpublish_category',
			'as'  =>'unpublish_category'
		]);

Route::get('/category/published/{id}',
		[	
			'uses'=>'CategoryController@publish_category_by_id',
			'as'  =>'publish_category'
		]);

Route::get('/category/delete/{id}',
		[	
			'uses'=>'CategoryController@category_delete',
			'as'  =>'category_delete'
		]);

Route::get('/category/edit/{id}',
		[	
			'uses'=>'CategoryController@edit_category',
			'as'  =>'edit_category'
		]);

Route::post('/category/update',
		[	
			'uses'=>'CategoryController@category_update',
			'as'  =>'category_update'
		]);



//product

Route::get('/product/add',
		[	
			'uses'=>'ProductController@product_form_show',
			'as'  =>'product_form'
		]);

Route::post('/product/add',
		[	
			'uses'=>'ProductController@productSave',
			'as'  =>'product_save'
		]);

Route::get('/product/manage',
		[	
			'uses'=>'ProductController@product_manage_view',
			'as'  =>'product_manage'
		]);

Route::get('/product/unpublish/{id}',
		[	
			'uses'=>'ProductController@unpublish_product_by_id',
			'as'  =>'unpublish_product'
		]);

Route::get('/product/publish/{id}',
		[	
			'uses'=>'ProductController@publish_product_by_id',
			'as'  =>'publish_product'
		]);

Route::get('/product/delete/{id}',
		[	
			'uses'=>'ProductController@delete_product_by_id',
			'as'  =>'delete_product'
		]);


Route::get('/product/edit/{id}',
		[	
			'uses'=>'ProductController@edit_product_by_id',
			'as'  =>'edit_product'
		]);


Route::post('/product/update',
		[	
			'uses'=>'ProductController@product_update',
			'as'  =>'product_update'
		]);

Route::get('/delete/product/manage',
		[	
			'uses'=>'ProductController@delete_product_manage_view',
			'as'  =>'delete_product_manage'
		]);

Route::get('/restore/product/{id}',
		[	
			'uses'=>'ProductController@restore_product_by_id',
			'as'  =>'restore_product'
		]);

Route::get('/force_delete/product/{id}',
		[	
			'uses'=>'ProductController@force_delete_product_by_id',
			'as'  =>'force_delete_product'
		]);

Route::get('/product/details/{id}',
		[	
			'uses'=>'FrontendController@product_details_view',
			'as'  =>'product_details'
		]);

// Route::get('shop/view',
// 		[	
// 			'uses'=>'FrontendController@shop_product_view',
// 			'as'  =>'shop_page_view'
// 		]);

Route::get('/shop/view','FrontendController@shop_product_view')->name('shop_page_view');

Route::get('category/product/view/{id}','FrontendController@show_category_products_by_cat_id')->name('show_category_products');

Route::post('/cart/add/product','CartController@product_add_to_cart')->name('add_to_cart');

Route::get('/cart/remove/product/{id}','CartController@cart_item_remove_product_by_id')->name('cart_item_remove');

Route::post('/cart/update/product','CartController@cart_item_update_product_by_id')->name('cart_item_update');


Route::get('/checkout/customer','CheckoutController@customer_form_view')->name('customer_form');

Route::post('checkout/customer','CheckoutController@customer_signup_info')->name('customer_signup');

Route::get('/checkout/shipping','CheckoutController@shipping_form_view')->name('shipping_form');

Route::post('/checkout/shipping','CheckoutController@shipping_info_save')->name('shipping_save');

Route::get('/checkout/payment','CheckoutController@payment_form_view')->name('payment_form');

Route::post('/checkout/payment','CheckoutController@order_info_save')->name('order_save');

Route::get('/order/manage','OrderController@order_manage_view')->name('order_manage');


Route::get('/order/details/{id}','OrderController@order_view_by_order_id')->name('order_view');


Route::get('/order/invoice/{id}','OrderController@order_invoice_by_order_id')->name('order_invoice');

Route::get('/order/invoice/download/{id}','OrderController@order_invoice_download_by_order_id')->name('order_invoice_download');


Route::get('/logout/customer','CheckoutController@logout_customer')->name('customer_logout');


Route::post('/login/customer','CustomerController@customer_login_check')->name('customer_login');





Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
