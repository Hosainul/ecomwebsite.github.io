@extends('admin.dashboard')

@section('title')
Update Product
@endsection

@section('dashboard_body')

@if (session('product_update_msg'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('product_update_msg')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<!-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

<form action="{{route('product_update')}}" method="POST" name="product_form" enctype="multipart/form-data">
      @csrf

  <div class="form-group row">
    <label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
    <div class="col-sm-10">
      <input type="text" name="product_name" class="form-control" id="product_name" value="{{$product->product_name}}">
       <input type="hidden" name="product_id" value="{{$product->id}}">

      @foreach ($errors->get('product_name') as $message)
          <span class="text-danger">{{$message}}</span>
      @endforeach

    </div>
  </div>

<div class="form-group row">
    <label for="category_id" class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-10">
      <select name="category_id" class="form-control" id="category_id" value="{{old('product_name')}}">
        <option value="">--Select--</option>

        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->category_name}}</option>
        @endforeach
  
      </select>
      @if ($errors->has('category_id'))
        <span class="text-danger">Category name is required</span>
      @endif
    </div>
  </div>

  <div class="form-group row">
    <label for="product_short_description" class="col-sm-2 col-form-label">Product Description</label>
    <div class="col-sm-10">
      <textarea id="product_short_description" class="form-control" name="product_short_description" rows="3">{{$product->product_short_description}}</textarea>
      @foreach ($errors->get('product_short_description') as $message)
          <span class="text-danger">{{$message}}</span>
      @endforeach
    </div>
  </div>

  <div class="form-group row">
    <label for="summary-ckeditor" class="col-sm-2 col-form-label">Product Detail Description</label>
    <div class="col-sm-10">
      <textarea id="summary-ckeditor" class="form-control" name="product_detail_description" rows="3">{{$product->product_detail_description}}</textarea>
      @foreach ($errors->get('product_detail_description') as $message)
          <span class="text-danger">{{$message}}</span>
      @endforeach
    </div>
  </div>

<div class="form-group row">
    <label for="product_price" class="col-sm-2 col-form-label">Product price</label>
    <div class="col-sm-10">
      <input type="text" name="product_price" class="form-control" id="inputEmail3" placeholder="product_price" value="{{$product->product_price}}">
       @foreach ($errors->get('product_price') as $message)
          <span class="text-danger">{{$message}}</span>
      @endforeach
    </div>
  </div>

  <div class="form-group row">
    <label for="product_image" class="col-sm-2 col-form-label">Product Image</label>
    <div class="col-sm-10">
      <input type="file" name="product_image" class="form-control" id="product_image">
       @foreach ($errors->get('product_image') as $message)
          <span class="text-danger">{{$message}}</span>
      @endforeach
    </div>
    <label for="product_image" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-3">
      <img src="{{asset('uploads/product_images')}}/{{$product->product_image}}" alt="" style="width: 120px; height: 145px;" class="img-fluid">
    </div>
    <div class="col-sm-6">
      
    </div>
  </div>

  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Publication Status</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="publication_status" id="publication_status" value="1" {{$product->publication_status == 1 ? 'checked':''}}>
          <label class="form-check-label" for="publication_status">
            Published
          </label>

        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="publication_status" id="publication_status_unpublish" value="0" {{$product->publication_status == 0 ? 'checked':''}}>
          <label class="form-check-label" for="publication_status_unpublish">
            Unpublished
          </label>
        </div>
        @foreach ($errors->get('publication_status') as $message)
          <span class="text-danger">{{$message}}</span>
          @endforeach
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update Product</button>
    </div>
  </div>
</form>


<script>
      document.forms['product_form'].elements['category_id'].value = {{$product->category_id}};
</script>

  @endsection