@extends('admin.dashboard')

@section('title')
Manage Delete Product
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


<h2>Delete Product</h2>

<table class="table table-borderd table-hover">
	<thead>
		<tr>
			<th>SN</th>
			<th>Product Name</th>
			<th>Category Id</th>
			<th>Product short Description</th>
			<th>Product Price</th>
			<th>Created Date</th>
			<th>Publication Status</th>
			<th>Action</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($softDeleteProducts as $softDeleteProduct)
			<tr>
				<td>{{$loop->index+1}}</td>
				<td>{{$softDeleteProduct->product_name}}</td>
				<td>{{$softDeleteProduct->category_id}}</td>
				<td>{{$softDeleteProduct->product_short_description}}</td>
				<td>{{$softDeleteProduct->product_price}}</td>
				<td>
					<img src="{{asset('uploads/product_images')}}/{{$softDeleteProduct->product_image}}" alt="" style="width: 120px; height: 145px;" class="img-fluid">
				</td>
				<td>{{$softDeleteProduct->created_at}}</td>
				<td>{{$softDeleteProduct->publication_status == 1 ? 'Published':'Unpublished'}}
				</td>

				<td>
					<div class="btn-group" role="group" aria-label="Button-group">

					<a href="{{route('restore_product',$softDeleteProduct->id)}}" class="btn btn-outline-warning">Restore</a>
					<a href="{{route('force_delete_product',$softDeleteProduct->id)}}" class="btn btn-outline-danger">Permanent Delete</a>
					
					</div>
				</td>
		</tr>
		@endforeach
	</tbody>
</table>


{{ $softDeleteProducts->links() }}

  @endsection