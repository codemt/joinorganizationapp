
<section class="page_topline ds table_section table_section_lg section_padding_top_15 section_padding_bottom_15 columns_margin_0">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 text-center text-lg-left hidden-xs">
				<div class="inline-content big-spacing">
					<div class="page_social">
						<a class="social-icon socicon-facebook" href="#" title="Facebook"></a>
						<a class="social-icon socicon-twitter" href="#" title="Twitter"></a>
						<a class="social-icon socicon-google" href="#" title="Google Plus"></a>
						<a class="social-icon socicon-linkedin"nhref="#" title="Linkedin"></a>
						<a class="social-icon socicon-youtube" href="#" title="Youtube"></a>
					</div>
					<span class="xs-block">
						<i class="fa fa-clock-o highlight3 rightpadding_5" aria-hidden="true"></i>
						Mon-Fri: 9:00-19:00; Sat: 10:00-17:00; Sun: Closed
					</span>
				</div>
			</div>
			<div class="col-lg-6 text-center text-lg-right">
				<div id="topline-animation-wrap">
					<div id="topline-hide" class="inline-content big-spacing">
						<span class="hidden-xs">
							<i class="fa fa-map-marker highlight3 rightpadding_5" aria-hidden="true"></i>
							603, Jaganath Shanker Seth Road, Mumbai
						</span>
						<span class="greylinks hidden-xs">
							<i class="fa fa-pencil highlight3 rightpadding_5" aria-hidden="true"></i>
							<a href="mailto:info@mumbaimaheshwari.com">info@mumbaimaheshwari.com</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<header class="page_header header_white toggler_xs_right columns_margin_0">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 display_table">
				<div class="header_left_logo display_table_cell">
					<a href="{{ route('website') }}" class="logo logo_with_text">
						<img src="{{ asset('www/img/logo.jpg') }}" alt="Logo">
					</a>
				</div>
				<div class="header_mainmenu display_table_cell text-center">
					<nav class="mainmenu_wrapper">
						<ul class="mainmenu nav sf-menu">
							<li class="active"> <a href="{{ route('website') }}">Home</a></li>
							<li> <a href="{{ route('about-us') }}">About Us</a></li>
							<li> <a href="{{ route('events') }}">Events</a></li>
							<!-- <li> <a href="{{ route('samitis') }}">Samitis</a></li> -->
							<li> <a href="{{ route('show_brochures') }}">Saraswani</a></li>
							<li> <a href="{{ route('gallery-list') }}">Gallery</a></li>
							<li> <a href="{{ route('orbituary-list') }}">Orbituary</a></li>
							<li> <a href="{{ route('contact-us') }}">Contacts</a></li>
						</ul>
					</nav>
					<!-- eof main nav -->
					<span class="toggle_menu"><span></span></span>
				</div>
				<div class="header_right_buttons display_table_cell text-right hidden-xs"> <a href="{{ route('member-registeration') }}" target="_blank" class="theme_button color2 margin_0">Register</a> </div>
			</div>
		</div>
	</div>
</header>
