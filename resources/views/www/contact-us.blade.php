@extends('layouts.webmaster')

@section('page-content')

<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Contact Us</h2>
				<ol class="breadcrumb greylinks">
					<li> <a href="index.html">
						Home
					</a> </li>
					<li class="active">Contact Us</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="ls columns_padding_25 section_padding_top_100 section_padding_bottom_100">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 to_animate" data-animation="scaleAppear">
							<h3>Contact Form</h3>
							<form class="contact-form row columns_padding_10" method="post" action="http://webdesign-finder.com/html/diversify/">
								<div class="col-sm-6">
									<div class="form-group bottommargin_0"> <label for="name">Full Name <span class="required">*</span></label> <input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="Full Name*"> </div>
								</div>
								<div class="col-sm-6">
									<div class="form-group bottommargin_0"> <label for="email">Email address<span class="required">*</span></label> <input type="email" aria-required="true" size="30" value="" name="email" id="email" class="form-control" placeholder="Email Address*"> </div>
								</div>
								<div class="col-sm-6">
									<div class="form-group bottommargin_0"> <label for="phone">Phone Number</label> <input type="text" size="30" value="" name="phone" id="phone" class="form-control" placeholder="Phone Number"> </div>
								</div>
								<div class="col-sm-6">
									<div class="form-group bottommargin_0"> <label for="subject">Subject</label> <input type="text" size="30" value="" name="subject" id="subject" class="form-control" placeholder="Your Subject"> </div>
								</div>
								<div class="col-sm-12">
									<div class="form-group bottommargin_0"> <label for="message">Message</label> <textarea aria-required="true" rows="5" cols="45" name="message" id="message" class="form-control" placeholder="Your Message..."></textarea> </div>
								</div>
								<div class="col-sm-12">
									<div class="contact-form-submit topmargin_20"> <button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color2 min_width_button margin_0">Send now</button> </div>
								</div>
							</form>
						</div>
						<!--.col-* -->
						<div class="col-sm-4 to_animate" data-animation="scaleAppear">
							<h3>Contact Info</h3>
							<div class="media small-media">
								<div class="media-left"> <i class="fa fa-map-marker highlight2"></i> </div>
								<div class="media-body">Maheshwari Pragati Mandel 603, Jaganath Shanker Seth Road,  Mumbai – 400 002. </div>
							</div>
							<div class="media small-media">
								<div class="media-left"> <i class="fa fa-clock-o highlight2"></i> </div>
								<div class="media-body">Fax : 2201 8834</div>
							</div>
							<div class="media small-media greylinks">
								<div class="media-left"> <i class="fa fa-pencil highlight2"></i> </div>
								<div class="media-body"> <a href="mailto:">info@mumbaimaheshwari.com</a> </div>
							</div>
							<div class="media small-media">
								<div class="media-left"> <i class="fa fa-phone highlight2"></i> </div>
								<div class="media-body">Tel : 2200 5026 / 27 /28 </div>
							</div>
						</div>
						<!--.col-* -->
					</div>
					<!--.row -->
				</div>
				<!--.container -->
			</section>
@endsection