@extends('admin.dashboard')

@section('title')
Manage Product
@endsection

@section('dashboard_body')


@if (session('unpublish_status_msg'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('unpublish_status_msg')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if (session('publish_status_msg'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('publish_status_msg')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if (session('product_delete_msg'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('product_delete_msg')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif




<table class="table table-borderd table-hover">
	<thead>
		<tr>
			<th>SN</th>
			<th>Product Name</th>
			<th>Category Id</th>
			<th>Product short Description</th>
			<th>Product Price</th>
			<th>Created Date</th>
			<th>Product Image</th>
			<th>Publication Status</th>
			<th>Action</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($products as $product)
			<tr>
				<td>{{$loop->index+1}}</td>
				<td>{{$product->product_name}}</td>
				<td>{{$product->relationToCategory->category_name}}</td>
				<td>{{$product->product_short_description}}</td>
				<td>{{$product->product_price}}</td>
				<td>{{$product->created_at? $product->created_at->diffForHumans() : '-----'}}</td>
				<td>
					<img src="{{asset('uploads/product_images')}}/{{$product->product_image}}" alt="" style="width: 120px; height: 145px;" class="img-fluid">
				</td>
				<td>{{$product->publication_status == 1 ? 'Published':'Unpublished'}}
				</td>

				<td>
					<div class="btn-group" role="group" aria-label="Button-group">
						@if ($product->publication_status == 1)
					<a href="{{route('unpublish_product',$product->id)}}" class="btn btn-outline-warning">Unpublish</a>
						@else
					<a href="{{route('publish_product',$product->id)}}" class="btn btn-outline-warning">Publish</a>
						@endif
					<a href="{{route('edit_product',$product->id)}}" class="btn btn-outline-warning">Edit</a>
					<a href="{{route('delete_product',$product->id)}}" class="btn btn-outline-danger">Delete</a>
					
					</div>
				</td>
		</tr>
		@endforeach
	</tbody>
</table>


{{ $products->links() }}




  @endsection