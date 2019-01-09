@extends('layouts.master')


@section('page-content')
<div class="title-bar">
   <h1 class="title-bar-title">
      <span class="d-ib">{{ucfirst($gallery->title)}} Gallery</span>
   </h1>
</div>
 <div class="row">
 @foreach($images as $image)
   <div class="col-md-4">
   	<img src="{{asset('gallery_images/'.$image)}}" class="img-responsive center-block">
   </div>
 @endforeach
</div>
@endsection