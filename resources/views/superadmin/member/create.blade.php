@extends('layouts.master') @push('page-style')
<style>
	.md-form-group {
		margin-bottom: 0px;
	}
</style>> 
@endpush 
@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add New Member</span>
	</h1>
	<p class="title-bar-description">
		<small>Note :- <span class="text-danger">*</span> marked fields are mandatory.</small>
	</p>
</div>
@if( Session::has('error'))
<div class="alert alert-danger alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Error!</strong> {{ Session::get('error') }}
</div>
@endif
<div class="row">
	<form class="form form-horizontal" method="post" action="{{ route('member.store') }}" enctype="multipart/form-data" onsubmit="return check_no();">
		{{ csrf_field() }}
		<div class="col-sm-9">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Proposer">Proposer</label>
				<div class="col-sm-9">
					<select name="member_id" class="form-control input-sm select" id="proposer">
						<option value="" selected="" disabled=""></option>
						@foreach($members as $members1)
						<option value="{{$members1->id}}">{{$members1->f_name}} {{$members1->l_name}} {{ "(".$members1->member_type }}{{ $members1->member_code.")" }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="photo">Upload Photo</label>
				<div class="col-sm-9">
					<input type="file" id="photo" onchange="document.getElementById('image_preview').src =window.URL.createObjectURL(this.files[0])"
					 name="profile_image" class="form-control">
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<img class="img-responsive" id="image_preview" src="{{ asset('img/profile.jpg') }}" alt="" style="width: 90px;height: 90px;">
		</div>
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bg-primary">
					<div class="card-actions">
						<button type="button" class="card-action card-toggler" title="Collapse"></button>
					</div>
					<strong>Personal Info</strong>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="">Enter Name <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<select name="salutation" class="form-control input-sm">
								<option selected="selected" value="Mr.">Mr.</option>
								<option value="Ms.">Ms.</option>
								<option value="Mrs.">Mrs.</option>
								<option value="Master">Master</option>
								<option value="Shri.">Shri</option>
								<option value="Smt.">Smt.</option>
								<option value="Dr.">Dr.</option>
							</select>
						</div>
						<div class="col-sm-2">
							<select name="l_name" id="l_name" class="form-control input-sm">
								<option selected="selected">Last Name</option>
								@foreach($surname as $data)
								<option value="{{$data->name}}" data-id="{{$data->id}}">{{$data->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-2">
							<input name="f_name" class="form-control input-sm" type="text" placeholder="First Name" required="">
						</div>
						<div class="col-sm-2">
							<input name="m_name" class="form-control input-sm" type="text" placeholder="Father / Husband Name" required="">
						</div>
						<div class="col-sm-2">
							<input name="mother_name" class="form-control input-sm" type="text" placeholder="Mother's Name" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dob">Date of Birth <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<input name="dob" id="dob" class="form-control input-sm" id="dob" type="text" value="" data-provide="datepicker" required="">
						</div>
						<label class="col-sm-2 control-label" for="">Gender</label>
						<div class="col-sm-6">
							<div class="md-form-group custom-controls-stacked">
								<div class="col-sm-4">
									<label class="custom-control custom-control-primary custom-radio">
										<input class="custom-control-input" type="radio" name="gender" value="Male" checked="checked">
										<span class="custom-control-indicator"></span>
										<span class="custom-control-label">Male</span>
									</label>
								</div>
								<div class="col-sm-4">
									<label class="custom-control custom-control-primary custom-radio">
										<input class="custom-control-input" type="radio" name="gender" value="Female">
										<span class="custom-control-indicator"></span>
										<span class="custom-control-label">Female</span>
									</label>
								</div>
								<div class="col-sm-4">
									<label class="custom-control custom-control-primary custom-radio">
										<input class="custom-control-input" type="radio" name="gender" value="Other">
										<span class="custom-control-indicator"></span>
										<span class="custom-control-label">Other</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="pincode">Pincode <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<select name="pincode" id="pincode" class="form-control" required="">
								@foreach($region as $region)
								@php
									$array = explode(",",$region['pincode']);
								

@endphp

								@foreach($array as $val)
									<option value="{{$val}}" data-ids="{{$val}}">{{$val}}</option>
								@endforeach

								@endforeach
							</select>
						</div>

						<label class="col-sm-2 control-label" for="khanp">Khanp <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<input name="khanp" id="khanp" class="form-control input-sm" type="text" placeholder="First Name" required="" disabled>
						</div>
						<label class="col-sm-2 control-label" for="up_khanp">UpKhanp</label>
						<div class="col-sm-2">
							<select class="form-control input-sm" name="up_khanp" id="up_khanp">

							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="marital_status">Marital Status</label>
						<div class="col-sm-2">
							<select class="form-control input-sm" name="marital_status" id="marital_status">

								<option value="Single">Single</option>
								<option selected="selected" value="Married">Married</option>
								<option value="Divorced">Divorced</option>
								<option value="Widow">Widow</option>
							</select>
						</div>
						<div id="marriage-date-div">
							<label class="col-sm-2 control-label" for="marriage-date">Date of Marriage </label>
							<div class="col-sm-2">
								<input name="dom" id="marriage-date" class="form-control input-sm" type="text" value="" data-provide="datepicker">
							</div>
						</div>
						<label class="col-sm-2 control-label" for="blood_group">Blood Group <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<select name="blood_group" id="blood_group" class="form-control input-sm" required="">
								<option selected="" disabled="">Choose Blood Group</option>
								<option value="A +">A +</option>
								<option value="A -">A -</option>
								<option value="AB +">AB +</option>
								<option value="AB -">AB -</option>
								<option value="B +">B +</option>
								<option value="B -">B -</option>
								<option value="O +">O +</option>
								<option value="O -">O -</option>
								<option value="B">B</option>
								<option value="N.A.">N.A.</option>
							</select>
						</div>



					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="contact">Mobile No:1 <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<input name="contact" id="contact" class="form-control input-sm" type="text" value="" required=""> @if($errors->has('contact'))
							<span class="text-danger"><strong>{{ $errors->first('contact')}}</strong></span> @endif
						</div>
						<label class="col-sm-2 control-label" for="alt_contact">Mobile No:2 </label>
						<div class="col-sm-2">
							<input name="alt_contact" id="alt_contact" class="form-control input-sm" type="text" value="">
						</div>
						<label class="col-sm-2 control-label" for="tel">Landline No. </label>
						<div class="col-sm-2">
							<input name="tel" id="tel" class="form-control input-sm" type="text" value="022">
						</div>
					</div>

					<label class="col-sm-2 control-label" for="contact"> Member Type <span class="text-danger">*</span></label>

					<div class="col-sm-4">
						<select name="member_type" class="form-control input-sm" id="member_type" required="">
							<option selected="" disabled="">Choose Member Type</option>
							<option value="LM">LM</option>
							<option value="PM">PM</option>
							<option value="SW">SW</option>
							<option value="NM">NM</option>
							<option value="OR">OR</option>
						</select>
					</div>

					<label class="col-sm-2 control-label" id="member_code"> Member Code : </label>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="card" aria-expanded="true">
				<div class="card card-collapsed" aria-expanded="true">
					<div class="card-header bg-primary">
						<div class="card-actions">
							<button type="button" class="card-action card-toggler" title="Collapse" aria-expanded="true"></button>
						</div>
						<strong>Address &amp; Qualification Details</strong>
					</div>
					<div class="card-body">

						<div class="form-group">
							<label class="col-sm-2 control-label" for="email">Email Id. </label>
							<div class="col-sm-4">
								<input name="email" id="email" class="form-control input-sm" type="email" value="">
							</div>
							<label class="col-sm-2 control-label" for="alt_email">Alternate Email Id. </label>
							<div class="col-sm-4">
								<input name="alt_email" id="alt_email" class="form-control input-sm" type="email" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="address">Address:1</label>
							<div class="col-sm-2">
								<textarea class="form-control input-sm" rows="1" name="address" id="address" spellcheck="false"></textarea>
							</div>
							<label class="col-sm-2 control-label" for="alt_address">Address:2</label>
							<div class="col-sm-2">
								<textarea class="form-control input-sm" rows="1" name="alt_address" id="alt_address" spellcheck="false"></textarea>
							</div>
							<label class="col-sm-2 control-label" for="alt_city">State</label>
							<div class="col-sm-2">
								<textarea class="form-control input-sm" rows="1" name="alt_city" id="alt_city" spellcheck="false"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="city">City</label>
							<div class="col-sm-4">
								<input name="city" id="city" class="form-control input-sm" type="text" value="">
							</div>

						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="occupation">Occupation </label>
							<div class="col-sm-2">
								<input name="occupation" id="occupation" class="form-control input-sm" type="text" value="">
							</div>
							<label class="control-label col-sm-2" for="company_details">Company Details </label>
							<div class="col-sm-2">
								<textarea class="form-control input-sm" rows="1" name="company_details" id="company_details" spellcheck="false"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="qualification">Qualification </label>
							<div class="col-sm-11">
								<select name="qualification_category" id="qualification_category" class="form-control input-sm">
								<option value="0">Select an option</option>
								@foreach($qualification_category as $val)
									<option value="{{$val['id']}}">{{$val['name']}}</option>
								@endforeach
							</select>
								<select name="qualification" id="qualification" class="form-control input-sm">
								
							</select>

							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-outline-primary add_more" title="Add More Qualification" tooltip>
									<i class="icon icon-plus-circle"></i>
								</button>
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-outline-danger remove" title="Add More Qualification" tooltip>
									<i class="icon icon-minus-circle"></i>
								</button>
							</div>
						</div>
						<div id="x"class="form-group" style="display: none">
						<div id="y" class="col-sm-11" style="margin-top:-30px">
								<label class="control-label col-sm-2" for="qualification">Qualification </label>
								<select name="qualification_category2" id="qualification_category" class="form-control input-sm">
								<option value="0">Select an option</option>
								@foreach($qualification_category as $val)
									<option value="{{$val['id']}}">{{$val['name']}}</option>
								@endforeach
							</select>
						</div>
						
						<div id="z" class="col-sm-11"> 
							<select name="qualification2" id="qualification" class="form-control input-sm qualification">

							</select>
						</div>

						</div>
						<div id="a"class="form-group" style="display: none">
								<div id="b" class="col-sm-11">
										<label class="control-label col-sm-2" for="qualification">Qualification </label>
										<select name="qualification_category3" id="qualification_category" class="form-control input-sm">
										<option value="0">Select an option</option>
										@foreach($qualification_category as $val)
											<option value="{{$val['id']}}">{{$val['name']}}</option>
										@endforeach
									</select>
								</div>
								
								<div id="c" class="col-sm-11"> 
									<select name="qualification3" id="qualification" class="form-control input-sm qualification">
		
									</select>
								</div>
		
								</div>
						<div class="form-group" id="other_qualification-div" style="display: none;">
							<label class="control-label col-sm-2" for="qualification"> About Qualification </label>
							<div class="col-sm-10">
								<textarea class="form-control input-sm" rows="1" name="other_qualification" spellcheck="false"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="native_address">Native Address</label>
							<div class="col-sm-2">
								<textarea class="form-control input-sm" rows="1" name="native_address" id="native_address" spellcheck="false"></textarea>
							</div>
							<label class="col-sm-2 control-label" for="dist">District</label>
							<div class="col-sm-2">
								<input name="dist" id="dist" class="form-control" type="text" value="">
							</div>
							<label class="col-sm-2 control-label" for="native_pincode">Pincode</label>
							<div class="col-sm-2">
								<input name="native_pincode" id="native_pincode" class="md-form-control" type="text" value="">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<button class="btn btn-lg btn-outline-primary">
					<i class="icon icon-paper-plane"></i> Submit Details
				</button>
				</div>
			</div>
	</form>
	</div>
@endsection
 @push('page-script')
	<script>


		$(".add_more").on('click',function(){

			
		
			 $("#x").css('display','block');
			$("#a").css('display','block');	
			

		})


		$(".remove").on('click',function(){



				$("#x").css('display','none');
				$("#a").css('display','none');

		})


		$("#y").on('change','select',function () { 
			
			$('#z').children("select.qualification").html("");
			// alert('helo'); 
			var selectedCategory = this.options[this.selectedIndex].text;
			var ele = $(this);
			console.log(ele);

			console.log($(this).val());
		if ( $(this).val() == "0" ) {

		}
		else {
			@foreach($qualification as $val)
				var id = {{$val['category']}};
				$('#z').children("select.qualification").append;
				if(id == ele.val())
				{
					$('#z').children("select.qualification").append('<option value="{{$val['name']}}">{{$val['name']}}</option></select>');
						
				}
			@endforeach
		}			
		
	});

		$("#b").on('change','select',function () { 
			
			$('#c').children("select.qualification").html("");
			// alert('helo'); 
			var selectedCategory = this.options[this.selectedIndex].text;
			var ele = $(this);
			console.log(ele);

			console.log($(this).val());
		if ( $(this).val() == "0" ) {

		}
		else {
			@foreach($qualification as $val)
				var id = {{$val['category']}};
				$('#c').children("select.qualification").append;
				if(id == ele.val())
				{
					$('#c').children("select.qualification").append('<option value="{{$val['name']}}">{{$val['name']}}</option></select>');
						
				}
			@endforeach
		}			
		
	});


		var i=0;
	
	

	

	$('#dob').datepicker({
		startDate: '-125y',
		endDate: '0'
	}).on('changeDate', function (ev) {

	});

	$("#marital_status").change(function() {
		if ( $(this).val() == "Married" ) {
			$("#marriage-date-div").show('slow');
		}
		else {
			$("#marriage-date-div").hide('slow');
		}
	});

	$("#qualification_category").change(function() {
		$("#qualification").html("");

		var ele = $(this);

		if ( $(this).val() == "0" ) {

		}
		else {
			@foreach($qualification as $val)
				var id = {{$val['category']}};
				if(id == ele.val())
				{
						$("#qualification").append('<option value="{{$val['name']}}">{{$val['name']}}</option>');
				}
			@endforeach
		}
	});


	$("#qualification").change(function() {
		if ( $(this).val() == "Other" ) {
			$("#other_qualification-div").show('slow');
		}
		else {
			$("#other_qualification-div").hide('slow');
		}
	});
	</script>

	<script type="text/javascript">
		$('#l_name').change(function(){
		var l_name = $(this).find("option:selected").attr("data-id");
		console.log(l_name);
    // alert(l_name);
    if(l_name){
    	$.ajax({
    		type:"GET",
    		url:"{{url('get-khunp-list')}}/"+l_name,
    		success:function(res){


    			console.log(res);
    			$('#khanp').val(res.khanp[0]['name']);

    			$("#up_khanp").empty();


    			$.each(res.upkhanp,function(key,value){
    				$("#up_khanp").append('<option value="'+value.id+'">'+value.name+'</option>');
    			})

    		}
    	});
    }
});

	$('#member_type').change(function(){
		var member_type = $(this).val();
		console.log(l_name);
		// alert(l_name);
		if(l_name){
			$.ajax({
				type:"GET",
				url:"{{url('get-member-code')}}/"+member_type,
				success:function(res){

					$("#member_code").text("Member Code : "+res);

				}
			});
		}
		});

	var members = [];
	$(document).ready(function() {

		@foreach($members6 as $members2)

		members.push('{{$members2->contact}}');

		@endforeach

	});

	function check_no()
	{
		if($.inArray($("#contact").val(), members) !== -1)
		{
			alert("Dupliacte contact number");
			return false;
		}

		return true;
	}
	</script>


	
@endpush