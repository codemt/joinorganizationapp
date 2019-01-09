@extends('layouts.master')

@push('page-style')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<style>
.btn-default {
	background-color: #1e8ad2;
	border-color: #1e8ad2;
}
.loader {
	display: none;
	position: fixed;
	left: 0;
	top: 0;
	z-index: 999;
	width: 100%;
	height: 100%;
	overflow: visible;
	background: rgba(60, 60, 60, 0.5);
}
</style>
@endpush
@section('page-content')
{{-- {{dd($events)}} --}}
<?php $events = $events[0];  ?>
<div class="row gutter-xs">
	<h1 class="title-bar-title" style="margin-bottom: 20px">
		<span class="d-ib">Edit Event</span>
	</h1>
	<form name="addevent" id="addeventform" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="loader">
		<div class="spinner spinner-primary spinner-lg"></div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header no-border">
	<input id="name" type="text" name="" placeholder="Enter Event Name" class="form-control" value="{{$events['name']}}">
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3">
						<h4>Select Regions</h4>
					</div>
					<div class="col-sm-9">
		<select id="region_select" class="form-control select" multiple="">
			<?php $region_copy = $region; ?>
		    @foreach ($region as $key => $region)

				@if(in_array($region->name, $events['region_array']))

	            <option value="{{ $region->id }}" data-nomember="{{sizeof(json_decode($region->members))}}" selected="selected">{{ $region->name }}</option>

				@else

				<option value="{{ $region->id }}" data-nomember="{{sizeof(json_decode($region->members))}}" >{{ $region->name }}</option>

				@endif

	        @endforeach
		</select>
					</div>
				</div>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<thead class="bg-primary">
							<tr>
								<th>#</th>
								<th>Region</th>
								<th>Total Members</th>
							</tr>
						</thead>
						<tbody id="region_table">
							@foreach ($region_copy as $key5 => $temp)

								@if(in_array($temp->name, $events['region_array']))

									 <tr>
										 <td>{{$key5+1}}</td>
										 <td>{{$temp->name}}</td>
										 <td>{{sizeof(json_decode($temp->members))}}</td>
									 </tr>

								@endif

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-5">
						<h4>Choose Sponsered Samiti</h4>
					</div>
					<div class="col-sm-7">
		<select id="samiti_select" class="form-control select" multiple="">
			<?php $samiti_copy = $samiti; ?>
		   	@foreach ($samiti as $key => $samiti1)

				@if(in_array($samiti1->name, $events['samiti_array']))

				<option value="{{ $samiti1->id }}" data-nomember="{{sizeof(json_decode($samiti1->members))}}" selected="selected">{{ $samiti1->name }}
		            </option>

				@else

				<option value="{{ $samiti1->id }}" data-nomember="{{sizeof(json_decode($samiti1->members))}}">{{ $samiti1->name }}
		            </option>

				@endif


	        @endforeach
		</select>
					</div>
				</div>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead class="bg-primary">
							<tr>
								<th>#</th>
								<th>Committee</th>
								<th>Total Members</th>
							</tr>
						</thead>
						<tbody id="samiti_table">
							@foreach ($samiti_copy as $key6 => $temp1)

								@if(in_array($temp1->name, $events['samiti_array']))

									 <tr>
										 <td>{{$key6+1}}</td>
										 <td>{{$temp1->name}}</td>
										 <td>{{sizeof(json_decode($temp1->members))}}</td>
									 </tr>

								@endif

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header no-border">
				<div class="row">
					<div class="col-sm-10">
						<h4>
							Sponsership Plan
						</h4>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-primary btn-sm Add_More_Plan" type="button" title="Add More Date & Time" tooltip data-placement="bottom">
							<i class="icon icon-plus-circle"></i>
						</button>
					</div>
				</div>
			</div>

			<?php $sponsorship_array = json_decode($events['sponsorship'],true); ?>

			<div class="card-body">

				@foreach ($sponsorship_array as $key => $items)

                    @if ($key > 0)
						<div class="Appended_Plan_container">
						<hr/>
						<button class="btn btn-sm btn-danger m-y-sm pull-right Remove_Appended_Plan_container" title="Remove Date and Time" tooltip>
						<i class="icon icon-times-circle"></i>
						</button>
						<div class="clearfix"></div>
                    @endif

					<div class="row sponsorship">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="" class="control-label">Name</label>
								<input class="form-control name" type="text" value="{{$items['name']}}">
							</div>
							<div class="form-group">
								<label for="" class="control-label">Price</label>
								<input class="form-control price" type="number" min="0"  value="{{$items['price']}}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="" class="control-label">Description</label>
								<textarea class="form-control description" rows="5" placeholder="Description">{{$items['description']}}</textarea>
							</div>
						</div>
					</div>

					@if ($key > 0)
						</div>
                    @endif

				@endforeach

				<div  class="Append_More_Plan_container"></div>

			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<textarea id="summernote" name="editordata">{{$events['description']}}</textarea>
			</div>
		</div>
	</div>

	{{-- end of col-xs-8 --}}
	{{--  --}}
	<?php $timing_array = json_decode($events['timing'],true); ?>

	<div class="col-sm-4">
		<div class="card">
			<div class="card-header no-border">
				<div class="row">
					<div class="col-sm-10">
						<h4>
							<i class="icon icon-calendar text-primary"></i> Event Date And Time
						</h4>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-primary btn-sm Add_More_DT" type="button" title="Add More Date & Time" tooltip data-placement="bottom">
							<i class="icon icon-plus-circle"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">

				@foreach ($timing_array as $key => $items)

					@if ($key > 0)
						<div class="Appended_DT_container datetime">
						<button class="btn btn-sm btn-danger m-y-sm pull-right Remove_Appended_DT_container" title="Remove Date and Time" tooltip>
						<i class="icon icon-times-circle"></i>
						</button>
						<div class="clearfix"></div>
					@endif

					@if ($key == 0)
						<div class="datetime">
					@endif

					<div class="row">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">From:</label>
							<div class="col-sm-5">
								<div class="input-with-icon">
									<input class="form-control input-sm start_date" type="text" data-provide="datepicker" value="{{$items["start_date"]}}">
									<span class="icon icon-calendar input-icon"></span>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="input-with-icon">
									<input class="form-control timepicker input-sm start_time" type="text" value="{{$items["start_time"]}}">
									<span class="icon icon-clock-o input-icon"></span>
								</div>
							</div>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">To:</label>
							<div class="col-sm-5">
								<div class="input-with-icon">
									<input class="form-control input-sm end_date" type="text" data-provide="datepicker" value="{{$items["end_date"]}}">
									<span class="icon icon-calendar input-icon"></span>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="input-with-icon">
									<input class="form-control timepicker input-sm end_time" type="text" value="{{$items["end_time"]}}">
									<span class="icon icon-clock-o input-icon"></span>
								</div>
							</div>
						</div>
					</div>

					@if ($key == 0)
						</div>
					@endif

					@if ($key > 0)
						</div>
					@endif

				@endforeach



				<div  class="Append_More_DT_container"></div>

			</div>
		</div>

		<div class="card">
			<div class="card-header bg-primary">
				<strong>Feature Image</strong>
			</div>
			<div class="card-body">
				<img class="img-responsive" id="image_preview" alt="" src="{{asset($events['featured_image'])}}" >
				<div class="form-group">
					<input type="file" onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])" name="featured_image" class="form-control">
				</div>
			</div>
		</div>

		<?php $category_array = json_decode($events['category'],true); ?>

		<div class="card">
			<div class="card-header bg-primary">
				<strong>Category</strong>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-xs-10">
				<input id="category_text" class="form-control input-sm" type="text" placeholder="Category">
					</div>
					<div class="col-xs-2">
				<button class="btn btn-primary btn-sm" id="add_category" type="submit">
					<i class="icon icon-plus-circle"></i>
				</button>
					</div>
				</div>
				<hr/>
				<div class="category_container" style="height: 100px; overflow-y: scroll;">

					@foreach ($category_array as $key9 => $temp9)

						<label class="custom-control custom-control-primary custom-checkbox">
						   <input class="custom-control-input category_check" type="checkbox" checked="checked">
						   <span class="custom-control-indicator"></span>
						   <span class="custom-control-label category_name_text">{{$temp9}}</span>
						</label>
										   <br/>

					@endforeach

				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header bg-primary">
				<strong> Select Venue</strong>
			</div>
			<div class="card-body">
				<select id="venue_select" class="form-control">
					<option selected disabled>Select Venue</option>
		@foreach ($venue as $key => $venue)

          @if ($events['venue_id'] == $venue->id)
            <option value="{{ $venue->id }}" selected="selected">{{ $venue->name }}</option>
		  @else
    	    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
          @endif

        @endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<button class="btn btn-outline-primary btn-lg btn-block" id="submit_event" type="submit">
		<i class="icon icon-paper-plane"></i> Update Event
	</button>
</form>
</div>



@endsection
@push('page-script')

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script>

	$('#summernote').summernote({
		height: 250,
		minHeight: null,
		maxHeight: null,
		focus: true,
		placeholder: 'Enter Description',
		toolbar: [
		[ 'font', [ 'bold', 'italic', 'underline','clear'] ],
		[ 'para', [ 'ol', 'ul'] ],
		[ 'view', [ 'undo', 'redo', 'fullscreen'] ]
		]
	});

	let Append_More_DT =`
	<div class="Appended_DT_container datetime">
	<button class="btn btn-sm btn-danger m-y-sm pull-right Remove_Appended_DT_container" title="Remove Date and Time" tooltip>
	<i class="icon icon-times-circle"></i>
	</button>
	<div class="clearfix"></div>
	<div class="row">
	<div class="form-group">
	<label for="" class="col-sm-2 control-label">From:</label>
	<div class="col-sm-5">
	<div class="input-with-icon">
	<input class="form-control input-sm start_date" type="text" data-provide="datepicker">
	<span class="icon icon-calendar input-icon"></span>
	</div>
	</div>
	<div class="col-sm-5">
	<div class="input-with-icon">
	<input class="form-control timepicker input-sm start_time" type="text">
	<span class="icon icon-clock-o input-icon"></span>
	</div>
	</div>
	</div>
	</div>
	<br/>
	<div class="row">
	<div class="form-group">
	<label for="" class="col-sm-2 control-label">To:</label>
	<div class="col-sm-5">
	<div class="input-with-icon">
	<input class="form-control input-sm end_date" type="text" data-provide="datepicker">
	<span class="icon icon-calendar input-icon"></span>
	</div>
	</div>
	<div class="col-sm-5">
	<div class="input-with-icon">
	<input class="form-control timepicker input-sm end_time" type="text">
	<span class="icon icon-clock-o input-icon"></span>
	</div>
	</div>
	</div>
	</div>
	</div>
	`;

	$(document).on('click','.Add_More_DT',function() {
		$('.Append_More_DT_container').append(Append_More_DT);
		$('.select').select2();
		$('[tooltip]').tooltip();
		$(".timepicker").timepicker();
	});

	$(document).on('click','.Remove_Appended_DT_container',function() {
		$(this).closest('.Appended_DT_container').remove();
	});

	let Append_More_Plan =
	`<div class="Appended_Plan_container">
	<hr/>
	<button class="btn btn-sm btn-danger m-y-sm pull-right Remove_Appended_Plan_container" title="Remove Date and Time" tooltip>
	<i class="icon icon-times-circle"></i>
	</button>
	<div class="clearfix"></div>
	<div class="row sponsorship">
	<div class="col-sm-6">
	<div class="form-group">
	<label for="" class="control-label">Name</label>
	<input class="form-control name" type="text">
	</div>
	<div class="form-group">
	<label for="" class="control-label">Price</label>
	<input class="form-control price" type="number" min="0">
	</div>
	</div>
	<div class="col-sm-6">
	<div class="form-group">
	<label for="" class="control-label">Description</label>
	<textarea class="form-control description" rows="5" placeholder="Description"></textarea>
	</div>
	</div>
	</div>
	</div>`;

	$(document).on('click','.Add_More_Plan',function() {
		$('.Append_More_Plan_container').append(Append_More_Plan);
	});

	$(document).on('click','.Remove_Appended_Plan_container',function() {
		$(this).closest('.Appended_Plan_container').remove();
	});

	$(document).on('click','#add_category',function() {

        $(".category_container").append(
        	`
 <label class="custom-control custom-control-primary custom-checkbox">
	<input class="custom-control-input category_check" type="checkbox" checked="">
	<span class="custom-control-indicator"></span>
	<span class="custom-control-label category_name_text">`+$("#category_text").val()+`</span>
 </label>
					<br/>
        	`);

	});

$('#region_select').change(function(e) {
	var region_name = [];
	var no_member = [];

       $('#region_select option:selected').each(function(){
            var $value =$(this).attr('data-nomember');
            no_member.push($value);
            var $text =$(this).text();
            region_name.push($text);
        });
		$("#region_table").empty();
		for(var i=0;i<region_name.length;i++){
	       $("#region_table").append(`
				<tr>
					<td>`+(i+1).toString()+`</td>
					<td>`+region_name[i]+`</td>
					<td>`+no_member[i]+`</td>
				</tr>
	       	`);
	    }

    });


$('#samiti_select').change(function(e) {
var samiti_name = [];
var no_member = [];

   $('#samiti_select option:selected').each(function(){
        var $value =$(this).attr('data-nomember');
        no_member.push($value);
        var $text =$(this).text();
        samiti_name.push($text);
    });
	$("#samiti_table").empty();
	for(var i=0;i<samiti_name.length;i++){
       $("#samiti_table").append(`
			<tr>
				<td>`+(i+1).toString()+`</td>
				<td>`+samiti_name[i]+`</td>
				<td>`+no_member[i]+`</td>
			</tr>
       	`);
    }

});

$(document).on('click','#submit_event',function() {

		var sponsorship = [];

		var datetime = [];

		var category = [];

		$(".sponsorship").each(function() {

	      var temp = {};
	      temp['name'] = $(this).find(".name").val();
	      temp['price'] = $(this).find(".price").val();
	      temp['description'] = $(this).find(".description").val();

          sponsorship.push(temp);

		});

		$(".datetime").each(function() {

	      var temp = {};
	      temp['start_date'] = $(this).find(".start_date").val();
	      temp['start_time'] = $(this).find(".start_time").val();
	      temp['end_date'] = $(this).find(".end_date").val();
	      temp['end_time'] = $(this).find(".end_time").val();

          datetime.push(temp);

		});

		$(".category_check").each(function() {

	      if($(this).is(":checked"))
	      {
 category.push($(this).parent().find(".category_name_text").text());
	      }

		});

	var form = $('#addeventform')[0];
	var formData = new FormData(form);
	formData.append('event_id', {{$events["id"]}});
formData.append('name', $('#name').val());
	formData.append('regions', $('#region_select').val());
	formData.append('samiti', $('#samiti_select').val());
formData.append('sponsorship', JSON.stringify(sponsorship).replace(/\\/g, ""));
formData.append('timing', JSON.stringify(datetime).replace(/\\/g, ""));
	formData.append('description', $('#summernote').summernote('code'));
	formData.append('category', JSON.stringify(category).replace(/\\/g, ""));
	formData.append('venue_id', $('#venue_select').val());

$('.loader').show();
         $.ajax({
				  url: "{{ route('update_event') }}",
				  method: "POST",
				  data: formData,
				  enctype: 'multipart/form-data',
				  processData: false,
				  contentType: false,
				  cache: false,
				  success: function(html){

					  $('.loader').hide();
 					alert("Updated Successfully");

 					window.location.href = '{{route('get_event')}}';


					 return;

				  }
				});

	});

</script>
@endpush
