@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add New Samiti</span>
	</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="demo-form-wrapper">
			<form class="form form-horizontal" method="post" action="{{ route('samiti.store') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-3 control-label" for="name">Name</label>
					<div class="col-sm-9">
						<input id="name" class="form-control" type="text" name="name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="c_year">Samiti Year</label>
					<div class="col-sm-9">
						@php
						$already_selected_value = 1984;
						$earliest_year = 1950;

						print '<select class="form-control" name="samiti_year" required>';
						foreach (range(date('Y'), $earliest_year) as $x) {
							print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
						}
						print '</select>';
						@endphp
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="c_year">Validity</label>
					<div class="col-sm-9">
						@php
						$earliest_year = 2018;

						print '<select class="form-control" name="valid_till" required>';
						foreach (range(2050, $earliest_year) as $x) {

                                print '<option value="'.$x.'">'.$x.'</option>';

						}
						print '</select>';
						@endphp
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="select-member">Add Regions</label>
					<div class="col-sm-9">
						<select name="region[]" id="select-region" class="form-control select" multiple="multiple" required>
					        @foreach ($region as $key => $region)

				                <option value="{{ $region->id }}">{{ $region->name }}</option>

				            @endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="select-admin">Select Admin</label>
					<div class="col-sm-4">
						<select id="admin_select" class="form-control select member_choose" name="admin_id" required>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="select-admin">Add Member</label>
					<div class="col-sm-4">
						<select id="select-admin" class="form-control select member_choose" name="member[]" required>
						</select>
					</div>
					<div class="col-sm-4">
						<input id="validity" class="form-control" type="text" value="" placeholder="Enter Designation" name="designation[]" required>
					</div>
					<div class="col-sm-1">
						<button type="button" class="btn btn-outline-primary add_more" title="Add More Member" tooltip>
							<i class="icon icon-plus-circle"></i>
						</button>
					</div>
				</div>
				<div class="append_container"></div>
				<div class="col-sm-offset-3 col-sm-9">
					<button class="btn btn-outline-primary">
						<i class="icon icon-paper-plane"></i> Submit Details
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('page-script')
<script>

  data_array = {};

	$(document).on('click','.add_more',function() {


		let append_data = `
		<div class="form-group">
			<label class="col-sm-3 control-label" for="select-admin">Add More Member</label>
			<div class="col-sm-4">
				<select id="select-admin" class="form-control select member_choose" name="member[]">`;

		$.each(data_array, function(i, item) {

	  		 if(item.member_type != null)
	  		 {

	  		   append_data +=`<option value="`+item.id+`">`+item.f_name+` `+item.l_name+` (`+item.member_type+` `+item.member_code+`)</option>`;

	  		 }
	  		 else
	  		 {

	  			   append_data +=`<option value="`+item.id+`">`+item.f_name+` `+item.l_name+` ()</option>`;

	  		 }


  		 })

		append_data += `</select>
			</div>
			<div class="col-sm-4">
				<input id="validity" class="form-control" type="text" value="" placeholder="Enter Designation" name="designation[]">
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-outline-danger remove_data" title="Remove Member" tooltip>
					<i class="icon icon-minus-circle"></i>
				</button>
			</div>
		</div>`;

		$('.append_container').append(append_data);
		$('.select').select2();
		$('[tooltip]').tooltip();
	});

	$(document).on('click','.remove_data',function() {
		$(this).closest('.form-group').remove();
	});


	$('#select-region').change(function(e) {
	   var selected = $(e.target).val();

	   console.log(selected);


	   $.ajax({
	  		   url: "{{ route('get_member_from_region') }}",
	  		   method: "POST",
	  		   data: {
	  			'region_id' : selected
	  			 },
	  		   cache: false,
	  		   success: function(html){

				   data_array = html.data;

				   $(".member_choose").each(function() {
					   $html = $(this);
					   var selected_id = $(this).val();
					   $(this).html("");
					   $.each(html.data, function(i, item) {

                      if(item.member_type != null)
					  {
						if(selected_id == item.id)
						{
 						$html.append(`<option value="`+item.id+`" selected="selected">`+item.f_name+` `+item.l_name+` (`+item.member_type+` `+item.member_code+`)</option>`);
						}
						else
						{
						$html.append(`<option value="`+item.id+`">`+item.f_name+` `+item.l_name+` (`+item.member_type+` `+item.member_code+`)</option>`);
						}

					  }
					  else
					  {
						  if(selected_id == item.id)
						  {
 					  		$html.append(`<option value="`+item.id+`" selected="selected">`+item.f_name+` `+item.l_name+` ()</option>`);
						  }
						  else
						  {
 					  		$html.append(`<option value="`+item.id+`">`+item.f_name+` `+item.l_name+` ()</option>`);
						  }

					  }


					  })
					})





	  		   }
	  		 });


   });
</script>
@endpush
