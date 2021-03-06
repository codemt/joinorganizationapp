@extends('layouts.master')

@push('page-style')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<style>
.btn-default {
	background-color: #1e8ad2;
	border-color: #1e8ad2;
}
.backdrop {

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
<div class="row gutter-xs backdrop">
	<h1 class="title-bar-title" style="margin-bottom: 20px">
		<span class="d-ib">Add Event</span>
	</h1>

	<form name="addevent" id="addeventform" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="loader">
			<div class="spinner spinner-primary spinner-lg"></div>
		</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header no-border">
	<input id="name" type="text" name="" placeholder="Enter Event Name" class="form-control" required>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3">
						<h4>Select Regions</h4>
					</div>
					<div class="col-sm-9">
		<select id="region_select" class="form-control select" multiple="" required>
		    @foreach ($region as $key => $region)

	            <option value="{{ $region->id }}" data-nomember="{{sizeof(json_decode($region->members))}}" >{{ $region->name }}</option>

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
							{{-- <tr>
								<td>1</td>
								<td>Mumbai Region</td>
								<td>12</td>
							</tr> --}}
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
		<select id="samiti_select" class="form-control select" multiple="" required>
			@foreach ($samiti as $key => $samiti)

	            <option value="{{ $samiti->id }}" data-nomember="{{sizeof(json_decode($samiti->members))}}">{{ $samiti->name }}
	            </option>

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
							{{-- <tr>
								<td>1</td>
								<td>Mumbai Committee</td>
								<td>12</td>
							</tr> --}}
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
			<div class="card-body">
				<div class="row sponsorship">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label">Name</label>
							<input class="form-control name" type="text" required>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Price</label>
							<input class="form-control price" type="number" min="0" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label">Description</label>
							<textarea class="form-control description" rows="5" placeholder="Description" required></textarea>
						</div>
					</div>
				</div>

				<div  class="Append_More_Plan_container"></div>

			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<textarea id="summernote" name="editordata"></textarea>
			</div>
		</div>
	</div>

	{{-- end of col-xs-8 --}}

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
				<div class="datetime">
				<div class="row">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">From:</label>
						<div class="col-sm-5">
							<div class="input-with-icon">
								<input class="form-control input-sm start_date" type="text" data-provide="datepicker" required>
								<span class="icon icon-calendar input-icon"></span>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="input-with-icon">
								<input class="form-control timepicker input-sm start_time" type="text" required>
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
								<input class="form-control input-sm end_date" type="text" data-provide="datepicker" required>
								<span class="icon icon-calendar input-icon"></span>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="input-with-icon">
								<input class="form-control timepicker input-sm end_time" type="text" required>
								<span class="icon icon-clock-o input-icon"></span>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div  class="Append_More_DT_container"></div>

			</div>
		</div>
		<div class="card">
			<div class="card-header bg-primary">
				<strong>Feature Image</strong>
			</div>
			<div class="card-body">
				<img class="img-responsive" id="image_preview" src="#" alt="">
				<div class="form-group">
					<input type="file" onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])" name="featured_image" class="form-control">
				</div>
			</div>
		</div>
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
					{{-- <label class="custom-control custom-control-primary custom-checkbox">
						<input class="custom-control-input" type="checkbox" checked="">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-label">Keep me signed in</span>
					</label>
					<br/> --}}

				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header bg-primary">
				<strong> Select Venue</strong>
			</div>
			<div class="card-body">
				<select id="venue_select" class="form-control" required>

		@foreach ($venue as $key => $venue)

            <option value="{{ $venue->id }}">{{ $venue->name }}</option>

        @endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<button class="btn btn-outline-primary btn-lg btn-block" id="submit_event" type="submit">
		<i class="icon icon-paper-plane"></i> Publish Event
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

		var error_sponsorship = false;

		var error_datetime = false;

		$(".sponsorship").each(function() {

	      var temp = {};



	      temp['name'] = $(this).find(".name").val();
	      temp['price'] = $(this).find(".price").val();
	      temp['description'] = $(this).find(".description").val();

		  if(temp['name'] == ""
	         || temp['price'] == ""
    		 || temp['description'] == "")
		  {
			  error_sponsorship = true;
		  }

          sponsorship.push(temp);

		});

		$(".datetime").each(function() {

	      var temp = {};
	      temp['start_date'] = $(this).find(".start_date").val();
	      temp['start_time'] = $(this).find(".start_time").val();
	      temp['end_date'] = $(this).find(".end_date").val();
	      temp['end_time'] = $(this).find(".end_time").val();

		  if(temp['start_date'] == ""
	         || temp['start_time'] == ""
    		 || temp['end_date'] == ""
		 	 || temp['end_time'] == "")
		  {
			  error_datetime = true;
		  }

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
	formData.append('name', $('#name').val());
	formData.append('regions', $('#region_select').val());
	formData.append('samiti', $('#samiti_select').val());
	formData.append('sponsorship', JSON.stringify(sponsorship).replace(/\\/g, ""));
	formData.append('timing', JSON.stringify(datetime).replace(/\\/g, ""));
	formData.append('description', $('#summernote').summernote('code'));
	formData.append('category', JSON.stringify(category).replace(/\\/g, ""));
	formData.append('venue_id', $('#venue_select').val());

     if($('#name').val() == ""
        || $('#region_select').val() == null
        || $('#samiti_select').val() == null
        || error_sponsorship
        || error_datetime)
	 {
		 return;
	 }
	 else
	 {

		 $('.loader').show();
			   $.ajax({
					   url: "{{ route('create_event') }}",
					   method: "POST",
					   data: formData,
					   enctype: 'multipart/form-data',
					   processData: false,
					   contentType: false,
					   cache: false,
					   success: function(html){
						   $('.loader').hide();
						  alert("Saved Successfully");

						  window.location.href = '{{route('get_event')}}';

						  return;

					   }
					 });

	 }

	});

</script>
@endpush
