@extends('layouts.webmaster')

@section('page-content')

<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>SARASWANI</h2>
				<ol class="breadcrumb greylinks">
					<li> <a href="index.html">
						Home
					</a> </li>
					<li class="active">SARASWANI</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="ls section_padding_bottom_100 columns_padding_30">
	<div class="container">
		<div class="row">
			@foreach($brochures as $brochure)
			<div class="col-sm-6">
				<div class="saraswani-box">
					<div class="row">
						<div class="col-sm-4">
							<img src="{{ asset('www/img/pdf1.png') }}" class="img-responsive img-thumbnail">
						</div>
						<div class="col-sm-8">
							<h4 class="text-center">{{ucfirst($brochure->title)}}</h4>
							<p class="text-center">{{$brochure->description}} </p>
							<div class="clearfix"></div>
							{{--<div class="text-center">
								
								<a href="{{route('brochure.show',$brochure->id)}}" class="theme_button min_width_button color2"><i class="fa fa-download"></i>  PDF</a>
							</div> --}}
							 <div class="col-xs-6">
								<a href="{{route('brochure_pdf',$brochure->id)}}" class="theme_button min_width_button color2" target="_blank"><i class="fa fa-eye"></i> PDF</a>
							</div> 							
							<div class="col-xs-6">
								<a href="{{route('brochure.show',$brochure->id)}}" class="theme_button min_width_button color2"><i class="fa fa-download"></i>  PDF</a>
							</div>

						</div>
					</div>
				</div>
			</div>
			@endforeach
{{-- 
			<div class="row topmargin_60">
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
			</div> --}}
		</div>
	</div>
</section>
@endsection