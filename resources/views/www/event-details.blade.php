@extends('layouts.webmaster')

@section('page-content')
<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center">
								<h2>Event Details</h2>
								<ol class="breadcrumb greylinks">
									<li> <a href="index.html">
										Home
									</a> </li>
									<li class="active">Event Details</li>
								</ol>
							</div>
						</div>
					</div>
				</section>

				 <section class="container">
				 	 <div class="row">
				 	 	<div class="col-sm-6">
				 	 		<div class="event-det-heading">
					 	 	 		 <h4>{{$events['name']}}</h4>
					 	 	 	</div>
				 	 		<div class="event-details-timetable">
					 	 	 	<div class="event-img text-center">
					 	 	 		<img src="{{asset($events['featured_image'])}}" width="100%">
					 	 	 		{{-- <div class="regi-btn mt-50">
					 	 	 			<a href="member-register.html" class="theme_button color2 margin_0">Register Now</a>
					 	 	 		</div> --}}
					 	 	 	</div>
				 	 	 	</div> <!--  end event-details-timetable -->
				 	 	</div>  
			 	 		 <div class="col-sm-6">
					 	 	 	<div class="event-det-heading  venue">
					 	 	 		 <h4 class="text-center">Venue: {{$events['venue_name']}}</h4>
					 	 	 	</div>

	<?php $timing_array = json_decode($events['timing'],true); ?>

			 	 		 	<div class="event-details-timetable">
			 	 		 			<div class="col-xs-6"><h5>Date:</h5></div>
					 	 	 		<div class="col-xs-6"><h5>Time:</h5></div>
					 	 	 		<div class="clearfix"></div>
					 	 	 	<div class="event-timetable">
	 	 	 						@foreach ($timing_array as $key => $items)

									<div class="col-xs-6">
					 	 	 			<p>{{$items["start_date"]}}</p>
					 	 	 		</div>
					 	 	 		<div class="col-xs-6">
					 	 	 			<p>{{$items["start_time"]}} To {{$items["end_time"]}} </p>
					 	 	 		</div>
	 	 	 						@endforeach

					 	 	 		<div class="col-xs-12">
					 	 	 			<h4 class="text-center">Sponsored Comittee</h4>
					 	 	 			<p class="text-center">
								 	@foreach ($events['samiti_array'] as $key => $samiti1)

									{{$samiti1}} <br>


							        @endforeach
							        </p>
					 	 	 		</div>
					 	 	 	</div>   <!-- event-timetable -->
				 	 	 	</div>   <!-- .event-details-timetable -->
			 	 		 </div>   <!-- end col-md-6 -->
				 	 </div>
				 	 	 <div class="clearfix"></div>
				 	 	 <div class="row">
				 	 	 <div class="col-sm-12">
				 	 	 	<div class="event-details-timetable">
					 	 	 	<div class="event-details">
					 	 	 		<div class="col-sm-6 event-details-heading">
					 	 	 			<h4>Event Details</h4>
					 	 	 		</div>
					 	 	 		<div class="col-sm-6 event-details-price">
					 	 	 			<h4 class="text-center">Entry : 4500</h4>
					 	 	 		</div>
					 	 	 		<div class="clearfix"></div>
					 	 	 		<p><?php echo $events['description']; ?></p>
					 	 	 	</div>
				 	 	 	</div>   <!-- event-details-timetable -->
				 	 	 </div> 
				 	 	</div> <!-- end row -->
				 	 	 <div class="col-sm-12 event-location">
				 	 	 	<h4 class="text-center">Map Location</h4>
				 	 	 	<div class="event-location-container">
					 	 	 	<div class="col-sm-8">
					 	 	 		<div class="container" id="map-canvas" style="height:300px;"></div>
					 	 	 	</div>
					 	 	 	<div class="col-sm-4">
					 	 	 		<h5>Address</h5>
					 	 	 		<p>{{$events['venue_address']}}</p>
					 	 	 		{{-- <button class="btn btn-default">Get Direction</button> --}}
					 	 	 	</div>
				 	 	 	</div> <!--  event-location-container -->
				 	 	 </div>
				 	 </div>
				 </section>
@endsection

@push('page-script')
<script>
	var map;
	var markers = [];

	function initMap() {
		map = new google.maps.Map(document.getElementById('map-canvas'), {
			center: {lat: -34.397, lng: 150.644},
			zoom: 8
		});


	var icon = {
		  url: 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png',
		  size: new google.maps.Size(71, 71),
		  origin: new google.maps.Point(0, 0),
		  anchor: new google.maps.Point(17, 34),
		  scaledSize: new google.maps.Size(25, 25)
		};

		var myLatlng = new google.maps.LatLng({{$events['lat']}},{{$events['lang']}});

		// Create a marker for each place.
		markers.push(new google.maps.Marker({
		  map: map,
		  icon: icon,
		  title: '{{$events['venue_address']}}',
		  position: myLatlng
		}));

		var bounds_temp = new google.maps.LatLngBounds();

		lat = {{$events['lat']}};

		lang = {{$events['lang']}};

		bounds_temp.extend(myLatlng);

 		map.fitBounds(bounds_temp);
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs6jCBFTbr5RKHR79KqJqkqB4JcO4XeRA&libraries=places&callback=initMap"
    async defer></script>
@endpush