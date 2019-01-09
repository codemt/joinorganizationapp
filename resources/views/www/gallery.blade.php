@extends('layouts.webmaster')

@section('page-content')

<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Events</h2>
				<ol class="breadcrumb greylinks">
					<li> 
						<a href="">	Home</a> 
					</li>
					<li class="active">Gallery</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="ls mt-50">
	<div class="container">
		<div class="event-heading mb-25">
			<h2 class="section_header color">Gallery</h2>
		</div>
		<div class="row">
			 @foreach($gallery as $gallery)
			<div class="col-sm-3">
				<a href="{{ route('gallery-photos',$gallery->id) }}">
					<div class="event-img">
						<img src="{{ asset('gallery_images/' . getFirstGalleryImage($gallery->id))  }}" class="img-thumbnail img-responsive center-block">
					</div>
					<h4 class="text-center text-capitalize">{{ $gallery->title }}</h4> 
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section> 

@endsection