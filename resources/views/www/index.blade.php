@extends('layouts.webmaster')

@section('page-content')
<section class="intro_section page_mainslider ds all-scr-cover bottom-overlap-teasers">
	<div class="flexslider" data-dots="true" data-nav="true">
		<ul class="slides">
			@for($i=0; $i<3; $i++)
			<li>
				<div class="slide-image-wrap"> <img src="{{ asset('www/img/slider.jpg') }}" alt="" />
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="slide_description_wrapper">
								<div class="slide_description">
									<div class="intro-layer" data-animation="fadeInRight">Community Center </div>
									<div class="intro-layer" data-animation="fadeInLeft">
										<h2> <span class="highlight3">Welcome</span><br>Mumbai Maheshwari </h2>
									</div>
									<div class="intro-layer" data-animation="fadeInRight">
										<p class="thin"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit</em></p>
									</div>
									<div class="intro-layer" data-animation="fadeInUp">
										<div class="slide_buttons"> <a href="{{ route('contact-us') }}" class="theme_button color1 min_width_button">Be Proud!</a> </div>
									</div>
								</div>								
							</div>							
						</div>
					</div>
				</div>
			</li>
			@endfor
		</ul>
	</div>
</section>
<section id="services" class="ls section_intro_overlap columns_padding_0 columns_margin_0 container_padding_0">
	<div class="container-fluid">
		<div class="row flex-wrap v-center-content">
			<div class="col-lg-3 col-sm-6 col-xs-12 to_animate" data-animation="fadeInUp">
				<div class="teaser main_bg_color transp with_padding big-padding margin_0">
					<div class="media xxs-media-left">
						<div class="media-left media-middle">
							<div class="teaser_icon size_small round light_bg_color thick_border_icon big_wrapper"> <i class="fa fa-twitter highlight" aria-hidden="true"></i> </div>
						</div>
						<div class="media-body media-middle">
							<h4><a href="#0">Member Resignation</a></h4>
							<p>Register your self , We are part of our growing community</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12 to_animate" data-animation="fadeInUp">
				<div class="teaser main_bg_color2 transp with_padding big-padding margin_0">
					<div class="media xxs-media-left">
						<div class="media-left media-middle">
							<div class="teaser_icon size_small round light_bg_color thick_border_icon big_wrapper"> <i class="fa fa-rocket highlight2" aria-hidden="true"></i> </div>
						</div>
						<div class="media-body media-middle">
							<h4><a href="#0">Matrimony Registration</a></h4>
							<p>Maheshwari mandal matrimony  mandal register now</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12 to_animate" data-animation="fadeInUp">
				<div class="teaser main_bg_color3 transp with_padding big-padding margin_0">
					<div class="media xxs-media-left">
						<div class="media-left media-middle">
							<div class="teaser_icon size_small round light_bg_color thick_border_icon big_wrapper"> <i class="fa fa-users highlight3" aria-hidden="true"></i> </div>
						</div>
						<div class="media-body media-middle">
							<h4><a href="#0">Job Opening</a></h4>
							<p>Get job across india for maheshwari community</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12 to_animate" data-animation="fadeInUp">
				<div class="teaser main_bg_color4 transp with_padding big-padding margin_0">
					<div class="media xxs-media-left">
						<div class="media-left media-middle">
							<div class="teaser_icon size_small round light_bg_color thick_border_icon big_wrapper"> <i class="fa fa-briefcase highlight4" aria-hidden="true"></i> </div>
						</div>
						<div class="media-body media-middle">
							<h4><a href="#0">Up-Coming Event</a></h4>
							<p>Stay informed about upcoming event</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="about" class="ls section_padding_top_110 columns_padding_30">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-push-6 to_animate" data-animation="fadeInUp" data-delay="600">
				<div class="embed-responsive embed-responsive-3by2"> 
					<img src="{{ asset('www/img/boost-employee-engagement.jpg') }}" alt="">
				</div>
			</div>
			<div class="col-md-6 col-md-pull-6 to_animate" data-animation="fadeInRight" data-delay="300">
				<h2 class="section_header color4"> Welcome To Maheshwari </h2>
				<p class="section-excerpt grey">Formed in 1957 only representative body of all Maheshwari families in the City of Mumbai.</p>
				<p>This Constitution, save and except provisions relating to "Board of Trustees" contained in Chapter VIII (Clauses 8.1 to 8.27), is approved and adopted in the Extraordinary General Meeting of the Mandal held on Saturday, 14th June, 2008. The provisions relating to "Board of Trustees" were approved and adopted in the Extraordinary General Meeting of the Mandal held on Saturday, 10th January, 2004.	 <a href="{{ route('about-us') }}" class="more-link">read more</a></p>
			</div>
		</div>
	</div>
</section>
<section id="contact" class="ls ">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 bottommargin_0 to_animate" data-animation="fadeInUp">
				<div class="ds bg_teaser with_padding big-padding"> <img src="{{ asset('www/img/banner.jpg') }}" alt="">
					<div class="row columns_padding_30">
						<div class="col-xs-12 col-sm-9 col-md-7 col-lg-6 col-sm-offset-3 col-md-offset-5 col-lg-offset-6">
							<h2 class="section_header color3">Do You Need Help?</h2>
							<p class="bottommargin_0">Contact us and we help you to solve any of your problem.</p>
							<form class="contact-form row columns_padding_10" method="post" action="http://webdesign-finder.com/html/diversify/">
								<div class="col-sm-6">
									<div class="form-group bottommargin_0"> <label for="name">Full Name <span class="required">*</span></label> <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name*"> </div>
								</div>
								<div class="col-sm-6">
									<div class="form-group bottommargin_0"> <label for="email">Email address<span class="required">*</span></label> <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email Address*"> </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group bottommargin_0"> <label for="message">Message</label> <textarea aria-required="true" rows="4" cols="45" name="message" id="message" class="form-control" placeholder="Your Message..."></textarea> </div>
								</div>
								<div class="col-sm-12 bottommargin_0">
									<div class="contact-form-submit topmargin_10"> <button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color3 min_width_button margin_0">Send now</button> </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="team" class="ls section_padding_top_90">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 bottommargin_0 to_animate" data-animation="fadeInUp">
				<h2 class="section_header color">Upcomming Events</h2>
				<div class="owl-carousel loop-colors topmargin_40" data-dots="false" data-nav="true" data-responsive-lg="3">
					@for($i=0; $i<10; $i++)
					<article class="vertical-item content-padding big-padding with_border  text-center">
						<div class="item-media"> 
							<img src="{{ asset('www/img/33.jpg') }}" alt=""> 
						</div>
						<div class="item-content">
							<header class="entry-header">
								<h3 class="entry-title small bottommargin_0"> 
									<a href="javascript:;">OM Prakash Mehta</a> 
								</h3>
							</header>
						</div>
					</article>
					@endfor
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="event-history mt-50 mb-25">
		<div class="event-heading mb-25">
			<h2 class="section_header color">SARASWANI</h2>
		</div>

		<section class="ls columns_padding_0 fluid_padding_0 section_padding_bottom_100">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<div class="owl-carousel related-photos-carousel loop-colors" data-margin="50" data-nav="false" data-dots="true" data-loop="true" data-items="3">
							@for($i=0; $i<10; $i++)
							<div>
								<article class="vertical-item content-padding post format-standard  with_border  text-center">
									<div class="item-media"> <img src="{{ asset('www/img/pdf1.png') }}" alt=""></div>
									<div class="item-content">
										<header class="entry-header">
											<h4 class="entry-title margin_0"> <a href="gallery-single.html" rel="bookmark">
												Om Prakash Mehta
											</a> </h4>
										</header>
									</div>
								</article>
							</div>
							@endfor
						</div>  
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection