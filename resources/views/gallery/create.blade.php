@extends('layouts.master')


@section('page-content')
<div class="title-bar">
   <h1 class="title-bar-title">
      <span class="d-ib">Add New Gallery</span>
   </h1>
   <p class="title-bar-description">
      <small>Note :- 
         <span class="text-danger">*</span> 
         marked fields are mandatory.
      </small>
   </p>
</div>
 
@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Success!</strong> Gallery Created Successfully.
</div>
@endif

<div class="row">
   <div class="col-md-8">
      <form class="form form-horizontal" action="{{ route('gallery.store') }}" method="post" enctype='multipart/form-data'>
         {{ csrf_field() }}
         <div class="form-group">
            <label class="col-sm-3 control-label" for="title">Title</label>
            <div class="col-sm-9">
               <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required="">
            </div>
         </div>
         <div class="form-group">
            <label class="col-sm-3 control-label" for="description">Description</label>
            <div class="col-sm-9">
               <textarea name="description" id="description" class="form-control"></textarea>
            </div>
         </div> 
         <div class="form-group">
            <label class="col-sm-3 control-label" for="description">Upload Images</label>
            <div class="col-sm-9">
               <input type="file" name="images[]" class="form-control" multiple="" required="" onchange="document.getElementById('image_preview').src =window.URL.createObjectURL(this.files[0])">
            </div>
         </div> 
         <div class="col-sm-offset-3 col-md-3">
            <button type="submit" class="btn btn-primary">
               <i class="icon icon-paper-plane"></i> Save Details
            </button>
         </div>
      </form>
   </div>
</div>

@endsection



