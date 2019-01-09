@extends('layouts.webmaster')
@push('page-style')
<link rel="stylesheet" href="css/lightboxify.css">
<style>
	.gallery {
	  width: 600px;
	  margin: auto;
	  border-radius: 3px;
	  overflow: hidden;
	  //position: relative;
	}
	.img-c {
	  width: 200px;
	  height: 200px;
	  float: left;
	  position: relative;
	  overflow: hidden;
	}

	.img-w {
	  position: absolute;
	  width: 100%;
	  height: 100%;
	  background-size: cover;
	  background-position: center;
	  cursor: pointer;
	  transition: transform ease-in-out 300ms;
	}

	.img-w img {
	  display: none;
	}

	.img-c {
	    transition: width ease 400ms, height ease 350ms, left cubic-bezier(0.4, 0, 0.2, 1) 420ms, top cubic-bezier(0.4, 0, 0.2, 1) 420ms;
	}

	.img-c:hover .img-w {
	  transform: scale(1.08);
	  transition: transform cubic-bezier(0.4, 0, 0.2, 1) 450ms;
	}

	.img-c.active {
	  width: 100% !important;
	  height: 100% !important;
	  position: absolute;
	  z-index: 2;
	  //transform: translateX(-50%);
	}

	.img-c.postactive {
	  position: absolute;
	  z-index: 2;
	  pointer-events: none;
	}

	.img-c.active.positioned {
	  left: 0 !important;
	  top: 0 !important;
	  transition-delay: 50ms;
	}
</style>
@endpush

@section('page-content')
<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Events</h2>
				<ol class="breadcrumb greylinks">
					<li> <a href="index.html">
						Home
					</a> </li>
					<li class="active">Events</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="ls columns_padding_30 mt-50" style="background-image: url(images/shiva.svg); background-repeat: no-repeat;background-size: cover;">
	<div class="container">
		<!-- <div class="lightbox-gallery">
			@foreach($images as $image)
			<div class="col-sm-4">
				<img src="{{ asset('gallery_images/'.$image) }}" data-image-hd="{{ asset('gallery_images/'.$image) }}" alt="">
			</div>
			@endforeach
		</div>	 -->

		<div class="gallery">
			@foreach($images as $image)
			  <div class="img-w">
			    	<img src="{{ asset('gallery_images/'.$image) }}" data-image-hd="{{ asset('gallery_images/'.$image) }}" alt="" />
			   </div>
			@endforeach
		</div>


	</div>
</section>

@endsection

@push('page-script')
<script>
	$(function() {
  $(".img-w").each(function() {
    $(this).wrap("<div class='img-c'></div>")
    let imgSrc = $(this).find("img").attr("src");
     $(this).css('background-image', 'url(' + imgSrc + ')');
  })
            
  
  $(".img-c").click(function() {
    let w = $(this).outerWidth()
    let h = $(this).outerHeight()
    let x = $(this).offset().left
    let y = $(this).offset().top
    
    
    $(".active").not($(this)).remove()
    let copy = $(this).clone();
    copy.insertAfter($(this)).height(h).width(w).delay(500).addClass("active")
    $(".active").css('top', y - 8);
    $(".active").css('left', x - 8);
    
      setTimeout(function() {
    copy.addClass("positioned")
  }, 0)
    
  }) 
  
  

  
})

$(document).on("click", ".img-c.active", function() {
  let copy = $(this)
  copy.removeClass("positioned active").addClass("postactive")
  setTimeout(function() {
    copy.remove();
  }, 500)
})
</script>
@endpush

