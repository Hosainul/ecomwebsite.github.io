@extends('admin.dashboard')

@section('title')
Manage Category
@endsection

@section('dashboard_body')

@if (session('unpublish_status_message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('unpublish_status_message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if (session('publish_status_message'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('publish_status_message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if (session('category_delete_message'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('category_delete_message')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif


<table class="table table-borderd table-hover">
	<thead>
		<tr>
			<th>SN</th>
			<th>Category Name</th>
			<th>Category Description</th>
			<th>Create Date</th>
			<th>Publication Status</th>
			<th>Action</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($categories as $category)
		<tr>
			<td>{{$loop->index+1}}</td>
			<td>{{$category->category_name}}</td>
			<td>{{$category->category_description}}</td>
			<td>{{$category->created_at}}</td>
			<td>{{$category->publication_status == 1 ? 'Published':'Unpublished'}}
			</td>

			<td>
				<div class="btn-group" role="group" aria-label="Button-group">
					@if ($category->publication_status == 1)
				<a href="{{route('unpublish_category',$category->id)}}" class="btn btn-outline-warning">Unpublish</a>
					@else
				<a href="{{route('publish_category',$category->id)}}" class="btn btn-outline-warning">Publish</a>
					@endif
				<a href="{{route('edit_category',$category->id)}}" class="btn btn-outline-warning">Edit</a>
				<a href="{{route('category_delete',$category->id)}}" class="btn btn-outline-danger">Delete</a>
				
			</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $categories->links() }}


  @endsection