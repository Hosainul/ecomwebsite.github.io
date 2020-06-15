@extends('admin.dashboard')

@section('title')
Add Category
@endsection

@section('dashboard_body')

@if (session('Category_add_msg'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('Category_add_msg')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($errors->any())
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
@endif

<form action="{{route('category_save')}}" method="POST">
      @csrf

  <div class="form-group row">
    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-10">
      <input type="text" name="category_name" class="form-control" id="inputEmail3" placeholder="category_name">
    </div>
  </div>
  <div class="form-group row">
    <label for="summary-ckeditor" class="col-sm-2 col-form-label">Categry Decription</label>
    <div class="col-sm-10">
      <textarea id="summary-ckeditor" class="form-control" name="category_description" rows="3"></textarea>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Publication Status</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="publication_status" id="publication_status" value="1">
          <label class="form-check-label" for="publication_status">
            Published
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="publication_status" id="publication_status_unpublish" value="0">
          <label class="form-check-label" for="publication_status_unpublish">
            Unpublished
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Category Add</button>
    </div>
  </div>
</form>


  @endsection