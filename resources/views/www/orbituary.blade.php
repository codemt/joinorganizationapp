@extends('layouts.webmaster')

@section('page-content')

<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Orbituary</h2>
				<ol class="breadcrumb greylinks">
					<li> <a href="index.html">
						Home
					</a> </li>
					<li class="active">Orbituary</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="ls columns_padding_30 mt-50">
	<div class="container">
		<div class="row">
			<div class="orbituary-border">

				@if (isset($obituary[0]))
					<div class="col-md-4">
						<div class="orbiruary-img" style="overflow:hidden;">
							<img src=" {{ asset($obituary[0]->photo) }} " class="img-responsive img-thumbnail" width="100%" >
						</div>
					</div>
					<div class="col-md-8">
	                	<h2 class="text-center">{{$obituary[0]->member_name}}</h2>
						<h4 class="text-center">({{$obituary[0]->birth_date}} To {{$obituary[0]->died_on}})</h4>
						<p>{{$obituary[0]->description}}</p>

						<div class="col-md-4  orbirury-box">
							<p>{{$obituary[0]->description_one}}</p>
						</div>
						<div class="col-md-4  orbirury-box" style="border-left: 2px solid #B1506B">
							<p>{{$obituary[0]->description_two}}</p>
						</div>
						<div class="col-md-4  orbirury-box" style="border-left: 2px solid #B1506B">
							<p>{{$obituary[0]->description_three}}</p>
						</div>
					</div>
				@endif

			</div>   <!-- orbituary-border -->
			<div class="clearfix"></div>
			<div class="orbituary-list mb-50">
				<div class="event-posts">
					<?php $count = 0; ?>
					@foreach ($obituary as $key => $value)
                     @php
                     	$count++;
                     @endphp

					@if ($count>1)
						<div class="col-md-3">
							<div class="event-img">
								<img src="{{ asset($obituary[0]->photo) }}" class="img-thumbnail img-responsive">
							</div>
							<div class="event-name">
								<p>{{$obituary[0]->member_name}}.</p>
								<small>Birth Date: {{$obituary[0]->birth_date}}</small>
								<small>Death Date: {{$obituary[0]->died_on}}</small>
							</div>
						</div>
					@endif

					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>
@endsection
