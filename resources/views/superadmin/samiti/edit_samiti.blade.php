@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Edit Samiti</span>
	</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="demo-form-wrapper">
			<form class="form form-horizontal" method="post" action="{{ route('samiti.update',$samiti->id) }}">
				{{ csrf_field() }}
                {{ method_field('PATCH') }}
				<?php $type = array(); ?>
				@if (Auth::user()["role"] == 1)
					<?php $type = getMemberType(); ?>
				@endif

				<div class="form-group">
					<label class="col-sm-3 control-label" for="name">Name</label>
					<div class="col-sm-9">
						<input id="name" class="form-control" type="text" name="name" value="{{$samiti->name}}" {{(in_array('RA',$type) || in_array('SM',$type))?'disabled':'required'}} >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="c_year">Samiti Year</label>
					<div class="col-sm-9">
						@php
						$already_selected_value = 1984;
						$earliest_year = 1950;

                        if(in_array("RA",$type) || in_array("SM",$type) || in_array("SA",$type))
						{
							print '<select class="form-control" name="samiti_year" disabled>';
							foreach (range(date('Y'), $earliest_year) as $x) {

	                        if($x == $samiti->samiti_year)
	                        {
	                            print '<option value="'.$x.'" selected="selected">'.$x.'</option>';
	                        }
	                        else
	                        {
	                            print '<option value="'.$x.'">'.$x.'</option>';
	                        }


							}
							print '</select>';
						}
						else
						{
							print '<select class="form-control" name="samiti_year" required>';
							foreach (range(date('Y'), $earliest_year) as $x) {

	                        if($x == $samiti->samiti_year)
	                        {
	                            print '<option value="'.$x.'" selected="selected">'.$x.'</option>';
	                        }
	                        else
	                        {
	                            print '<option value="'.$x.'">'.$x.'</option>';
	                        }


							}
							print '</select>';
						}

						@endphp
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="c_year">Validity</label>
					<div class="col-sm-9">
						@php
						$earliest_year = 2018;

						if(in_array("RA",$type) || in_array("SM",$type) || in_array("SA",$type))
						{
							print '<select class="form-control" name="valid_till" disabled>';
							foreach (range(2050, $earliest_year) as $x) {
							    if($x == $samiti->valid_till)
	                            {
	                                print '<option value="'.$x.'" selected="selected">'.$x.'</option>';
	                            }
	                            else
	                            {
	                                print '<option value="'.$x.'">'.$x.'</option>';
	                            }
							}
							print '</select>';
						}
						else
						{
							print '<select class="form-control" name="valid_till" required>';
							foreach (range(2050, $earliest_year) as $x) {
							    if($x == $samiti->valid_till)
	                            {
	                                print '<option value="'.$x.'" selected="selected">'.$x.'</option>';
	                            }
	                            else
	                            {
	                                print '<option value="'.$x.'">'.$x.'</option>';
	                            }
							}
							print '</select>';
						}

						@endphp
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label" for="select-member">Add Regions</label>
					<div class="col-sm-9">
						<select name="region[]" id="select-region" class="form-control select" multiple="multiple" {{(in_array("RA",$type) || in_array("SM",$type) || in_array("SA",$type))?"disabled":"required"}}>
					        @foreach ($region_array as $key => $region)

				                <option value="{{ $region->id }}" {{in_array($region->id,$regions)?'selected' : ''}}>{{ $region->name }}</option>

				            @endforeach
						</select>
					</div>
				</div>

				<div class="append_container1">

				</div>
{{--
				@if(count($members)<=0)
					<div class="form-group">

							<label class="col-sm-3 control-label" for="select-admin">Add Member</label>

							<div class="col-sm-4">
							<select id="select-admin" class="form-control select" name="member[]" required>

								@foreach($member_array3 as $key1 => $a)

								 	<option value="{{ $a->id }}" selected="selected">{{ $a->f_name }} {{ $a->l_name }} {{ "(".$a->member_type }}{{ $a->member_code.")" }}</option>


								@endforeach

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
				@endif

                @foreach ($members as $key => $member1)

                    <div class="form-group">
                        @if ($key == 0)
                            <label class="col-sm-3 control-label" for="select-admin">Add Member</label>

                        @else
                            <label class="col-sm-3 control-label" for="select-admin">Add More Members</label>

                        @endif
    						<div class="col-sm-4">
    						<select id="select-admin" class="form-control select" name="member[]" required>

								@foreach($member_array1 as $key1 => $a)

                                  @if ($a->id == $member1['member'])
                                    <option value="{{ $a->id }}" selected="selected">{{ $a->f_name }} {{ $a->l_name }} {{ "(".$a->member_type }}{{ $a->member_code.")" }}</option>
                                  @else
                                    <option value="{{ $a->id }}">{{ $a->f_name }} {{ $a->l_name }} {{ "(".$a->member_type }}{{ $a->member_code.")" }}</option>
                                  @endif

                                @endforeach

    						</select>
    					</div>
    					<div class="col-sm-4">
    						<input id="validity" class="form-control" type="text" value="{{$member1['designation']}}" placeholder="Enter Designation" name="designation[]" required>
    					</div>
    					<div class="col-sm-1">
                            @if ($key == 0)
                                <button type="button" class="btn btn-outline-primary add_more" title="Add More Member" tooltip>
        							<i class="icon icon-plus-circle"></i>
        						</button>
                            @else
                                <button type="button" class="btn btn-outline-danger remove_data" title="Remove Member" tooltip>
                                    <i class="icon icon-minus-circle"></i>
                                </button>
                            @endif
    					</div>
    				</div>

                @endforeach  --}}

				<div class="append_container">

				</div>
				<div class="col-sm-offset-3 col-sm-9">
					<button class="btn btn-outline-primary" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":""}}>
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

	  $(document).ready(function(){
	  	let selected = $('#select-region').val();
	  	$.ajax({
	  		   url: "{{ route('get_member_from_region') }}",
	  		   method: "POST",
	  		   data: {
	  			'region_id' : selected
	  			 },
	  		   cache: false,
	  		   success: function(html){

				   data_array = html.data;
				}

			});


	  	let append_data = '';
	@foreach($members as $index => $memb)
		append_data += `<div class="form-group">
        <label class="col-sm-3 control-label" for="select-admin">Add More Member</label>
		<div class="col-sm-4">
			<select id="select-admin" class="form-control select member_choose" name="member[]" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":"required"}}>`;
    	@foreach(getMemberByRegion($regions) as $member)
   		append_data += `<option value="{{ $member->id }}" {{strval($member->id) == $memb['member'] ? 'selected' : ''}}>{{ $member->f_name }} {{ $member->l_name }} ({{$member->member_type}}{{$member->member_code}})</option>`;
   		@endforeach

	append_data += `</select>
		</div>
		<div class="col-sm-4">
			<input id="validity" class="form-control" type="text" value="{{$memb['designation']}}" placeholder="Enter Designation" name="designation[]" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":"required"}}>
		</div>`;
		@if($index == 0)
		append_data += `<div class="col-sm-1"><button type="button" class="btn btn-outline-primary add_more" title="Add More Member" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":""}} tooltip>
							<i class="icon icon-plus-circle"></i>
						</button></div>`;
		@else
		append_data += `<div class="col-sm-1">
			<button type="button" class="btn btn-outline-danger remove_data" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":""}} title="Remove Member" tooltip>
				<i class="icon icon-minus-circle"></i>
			</button></div>`;
		@endif
		append_data += `</div>`;
	@endforeach
	console.log(append_data);
		$('.append_container').append(append_data);

		let append_data1 = `<div class="form-group">
			<label class="col-sm-3 control-label" for="select-admin">Select Admin</label>
			<div class="col-sm-4">
				<select id="admin_select" class="form-control select member_choose" name="admin_id" {{(in_array("RA",$type) || in_array("SM",$type) || in_array("SA",$type))?"disabled":"required"}}>`;
		@foreach(getMemberByRegion($regions) as $member)
		append_data1 += `<option value="{{ $member->id }}" {{strval($member->id) == $admin_id ? 'selected' : ''}}>{{ $member->f_name }} {{ $member->l_name }} ({{$member->member_type}}{{$member->member_code}})</option>`;
		@endforeach
		append_data1 += `</select>
			</div></div>`;
		$('.append_container1').append(append_data1);

	  })



	$(document).on('click','.add_more',function() {


		let append_data = `
		<div class="form-group">
			<label class="col-sm-3 control-label" for="select-admin">Add More Member</label>
			<div class="col-sm-4">
				<select id="select-admin" class="form-control select member_choose" name="member[]" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":"required"}}>`;

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
				<input id="validity" class="form-control" type="text" value="" placeholder="Enter Designation" name="designation[]" {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":"required"}}>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-outline-danger remove_data" title="Remove Member" tooltip {{(!in_array("SA",$type) && sizeof($type)>0)?"disabled":""}}>
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

	   if(selected == null){
	   	$('.member_choose').empty();
	   	$('.append_container').not('div:first').empty();
	   	return false;
	   }
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
