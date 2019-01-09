@extends('layouts.webmaster')

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


<section class="ls columns_padding_30">
	<div class="container">
		<div class="row">
			{{-- <div class="search">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					<form method="get" class="searchform" action="">
						<div class="col-md-3">
							<div class="form-group margin_0">
								<input id="widget-search" type="text" value="" name="search" class="form-control" placeholder="Region">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group margin_0">
								<input id="widget-search" type="text" value="" name="search" class="form-control" placeholder="Category">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group margin_0">
								<input id="widget-search" type="text" value="" name="search" class="form-control" placeholder="Month">
							</div>
						</div>
						<div class="col-md-3 text-center">
							<button type="submit" class="theme_button color1">Search</button>
						</div>
					</form>
				</div>
			</div>    --}}
			<div class="clearfix"></div>
			<div class="events" style="margin-top: 30px;">
				<div class="upcomming-event mb-50">
					<div class="event-heading mb-25">
						<h2 class="section_header color">Upcomming Events</h2>
					</div>
					<div class="event-posts">
						@foreach($event as $event1)


						<div class="col-md-3">
							<a href="{{ route('event-details',$event1['id']) }}">
								<div class="event-img">
									<img src="{{asset($event1['featured_image'])}}" class="img-thumbnail img-responsive">
								</div>
								<div class="event-name">
									<p>{{$event1['name']}}</p>
								</div>
							</a>
						</div>
						@endforeach
						<div class="clearfix"></div>

					</div>

					<!--<div class="row topmargin_60">
						<div class="col-sm-12 text-center">
							<ul class="pagination">
								<li><a href="#"><span class="sr-only">Prev</span><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
								<li class="active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#"><span class="sr-only">Next</span><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>-->
				</div>  <!-- end upcomming event -->
			</div>


			<div class="clearfix"></div>
			<!-- <div class="event-history mt-50 mb-25">
				<div class="event-heading mb-25">
					<h2 class="section_header color">Events History</h2>
				</div>

				<section class="ls columns_padding_0 fluid_padding_0 section_padding_bottom_100">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12">
								<div class="owl-carousel related-photos-carousel loop-colors" data-margin="50" data-nav="false" data-dots="true" data-loop="true" data-items="3">
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/11.jpg" alt=""></div>
											<div class="item-content">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Prakash Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/22.jpg" alt=""></div>
											<div class="item-content plan2">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Prakash Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/33.jpg" alt=""></div>
											<div class="item-content plan3">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/44.jpg" alt=""></div>
											<div class="item-content plan4">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/11.jpg" alt=""></div>
											<div class="item-content">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/22.jpg" alt=""></div>
											<div class="item-content plan2">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/33.jpg" alt=""></div>
											<div class="item-content plan3">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/44.jpg" alt=""></div>
											<div class="item-content plan4">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/11.jpg" alt=""></div>
											<div class="item-content plan4">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/22.jpg" alt=""></div>
											<div class="item-content plan4">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Praksh Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/33.jpg" alt=""></div>
											<div class="item-content plan4">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Prakash Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
									<div>
										<article class="vertical-item content-padding post format-standard  with_border  text-center">
											<div class="item-media"> <img src="images/events/44.jpg" alt=""></div>
											<div class="item-content plan4">
												<header class="entry-header">
													<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
														Om Prakash Mehta
													</a> </h4>
												</header>
											</div>
										</article>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div> -->
		</div>
	</div>
</section>

@endsection
