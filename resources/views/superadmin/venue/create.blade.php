@extends('layouts.master')

@push('page-style')
<style>
#map {
	height: 100%;
}
</style>
@endpush

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add Venue</span>
	</h1>
</div>
<form>
<div class="row">
	<div class="col-sm-8">
		<div class="demo-form-wrapper">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="name">Name</label>
					<div class="col-sm-9">
						<input id="name" class="form-control" type="text" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="Capacity">Capacity</label>
					<div class="col-sm-9">
						<input id="capacity" class="form-control" type="text" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="Rent">Rent</label>
					<div class="col-sm-9">
						<input id="rent" class="form-control" type="text" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="ContactPerson">Contact Person</label>
					<div class="col-sm-9">
						<input id="contactperson" class="form-control" type="text" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="ContactNumber">Contact Number</label>
					<div class="col-sm-9">
						<input id="contactnumber" class="form-control" type="text" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="ContactNumber">Address</label>
					<div class="col-sm-9">
						<input id="actual_address" class="form-control" type="text" value="" required>
					</div>
				</div>
				<div class="col-sm-offset-3 col-sm-9">
					<button class="btn btn-outline-primary" id="submit">
						<i class="icon icon-paper-plane"></i> Submit Details
					</button>
				</div>
		</div>
	</div>
	<div class="col">
		<input id="pac-input" class="controls col-sm-8" type="text" placeholder="Search Box" style="height: 40px;">
		<div class="container" id="map-canvas" style="height:300px;"></div>
	</div>
</div>
</form>
@endsection
@push('page-script')
<script>
	var map;
	var lat;
	var lang;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map-canvas'), {
			center: {lat: -34.397, lng: 150.644},
			zoom: 8
		});

  var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            lat = place.geometry.location.lat();

            lang = place.geometry.location.lng();

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

	$(document).on("click","#submit", function() {

	    $.ajax({
				  url: "{{ route('create_venue') }}",
				  method: "GET",
				  data: {
				   'name' : $("#name").val() ,
				   'capacity' : $("#capacity").val(),
				   'rent' : $("#rent").val(),
				   'contactperson' : $("#contactperson").val(),
				   'contactnumber' : $("#contactnumber").val(),
				   'address' : $("#pac-input").val(),
				   'actual_address' : $("#actual_address").val(),
				   'lat' : lat,
				   'lang' : lang,
					},
				  cache: false,
				  success: function(html){
				     alert("Saved Successfully");

				     window.location.href = '{{route('get_venue')}}';


					 return;
				  }
				});

	});

	}



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs6jCBFTbr5RKHR79KqJqkqB4JcO4XeRA&libraries=places&callback=initMap"
    async defer></script>
@endpush
