@extends('layouts.webmaster')

@push('page-style')
<style type="text/css">
.text-danger { color: #f50500 }
</style>
<link rel="stylesheet" href="{{ asset('www/css/datepicker.css') }}" >
@endpush

@section('page-content')
<section class="page_breadcrumbs ds background_cover section_padding_top_65 section_padding_bottom_65">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Member Registration</h2>
				<ol class="breadcrumb greylinks">
					<li> <a href="">
						Home
					</a> </li>
					<li class="active">Member Registration</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="mt-50">
	<div class="container">
		@if( Session::has('success'))
		<div class="alert alert-success alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> You are registered successfully <a href="http://membership.suboffice.in"> Proceed To Login</a>
		</div>
		@endif

		@if( Session::has('error'))
		<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Error!</strong> {{ Session::get('error') }}
		</div>
		@endif
		<div class="row registration-form">
			<form class="" method="post" action="{{ route('member-register') }}" enctype="multipart/form-data" onsubmit="return check_no();">
				{{ csrf_field() }}
				<div id="faq-accordion" class="panel-group collapse-unstyled">
					<div class="panel">
						<div class="regi-head">
							<a data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse1" class="collapsed"><h5>Choose Proposer</h5></a>
						</div>
						<div id="faq-collapse1" class="panel-collapse collapse">
							<div class="panel-content">
								<div class="regi-input">
									<div class="col-sm-4 col-sm-offset-3">
										<div class="form-group">
											<label for="proposer">Proposer:</label>
											<select name="member_id" class="" id="proposer">
												<option value="" selected="" disabled="">Choose Proposer</option>
												@foreach($members as $members1)
												<option value="{{$members1->id}}">{{$members1->f_name}} {{$members1->l_name}} {{ "(".$members1->member_type }}{{ $members1->member_code.")" }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group topmargin_35">
											<a class="theme_button color2 margin_0 text-center " data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse2">
												Next <i class="fa fa-angle-double-right"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="panel">
						<div class="regi-head">
							<a  data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse2" class="collapsed"><h5>Personal Information</h5></a>
						</div>
						<div id="faq-collapse2" class="panel-collapse collapse">
							<div class="panel-content">
								<div class="col-sm-2">
									<div class="form-group">
										<label for="salutation">Salutation: <span class="text-danger">*</span></label>
										<select name="salutation" id="salutation">
											<option selected="selected" value="Mr.">Mr.</option>
											<option value="Ms.">Ms.</option>
											<option value="Mrs.">Mrs.</option>
											<option value="Master">Master</option>
											<option value="Shri.">Shri</option>
											<option value="Smt.">Smt.</option>
											<option value="Dr.">Dr.</option>
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<label for="l_name">Surname: <span class="text-danger">*</span></label>
									<select name="l_name" id="l_name" class=""  required="">
										@foreach($surname as $data)
										<option value="{{$data->name}}" data-ids="{{$data->id}}">{{$data->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										<label for="f_name">Name: <span class="text-danger">*</span></label>
										<input name="f_name" class="form-control" type="text" placeholder="First Name" required="">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="m_name">Father/ Husband Name: <span class="text-danger">*</span></label>
										<input name="m_name" class="form-control" type="text" placeholder="Father / Husband Name" required="">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="mother_name">Mother's Name: <span class="text-danger">*</span></label>
										<input name="mother_name" class="form-control" type="text" placeholder="Mother's Name" id="mother_name" required="">
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-6">
									<label for="pincode">Pincode : <span class="text-danger">*</span></label>
									<select name="pincode" id="pincode" class=""  required="">
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
								<div class="col-sm-8">
									<div class="row">
										<div class="col-xs-6">
											<div class="form-group">
												<label for="dob">Date Of Birth: <span class="text-danger">*</span></label>
												<input name="dob" id="dob" class="form-control input-sm" id="dob" type="text" value="" data-provide="datepicker" required="">
											</div>
										</div>
										<div class="col-xs-6">
											<div class="form-group">
												<label for="rdo-1">Gender: <span class="text-danger">*</span></label>
												<div class="cntr">
													<label for="rdo-1" class="btn-radio">
														<input type="radio" id="rdo-1" name="gender" value="Male" >

														<span>Male</span>
													</label>
													<label for="rdo-2" class="btn-radio">
														<input type="radio" id="rdo-2" name="gender" value="Female">

														<span>Female</span>
													</label>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6">
											<label for="khanp">Khanp: <span class="text-danger">*</span></label>
											<input name="khanp" id="khanp" class="form-control input-sm" type="text" required="" disabled>
										</div>

										<div class="col-sm-6">
											<label for="up_khanp">UpKhanp: </label> <br>
											<select class="noclass" name="up_khanp" id="up_khanp" style="width: 320px;">

											</select>
										</div>


									</div>
								</div>
								<div class="col-sm-4">
									<img class="img-thumbnail img-responsive" style="width: 130px;" id="image_preview" src="{{ asset('www/img/profile.jpg') }}" >
									<br/>
									<label for="photo">Upload Profile</label>
									<input type="file" id="photo" onchange="document.getElementById('image_preview').src =window.URL.createObjectURL(this.files[0])" name="profile_image" class="form-control">
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="marital_status">Marital Status:</label>
										<select class="" name="marital_status" id="marital_status">

											<option value="Single">Single</option>
											<option selected="selected" value="Married">Married</option>
											<option value="Divorced">Divorced</option>
											<option value="Widow">Widow</option>
										</select>
									</div>
								</div>
								<div id="marriage-date-div">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="marriage-date">Date of Marriage:</label>
											<input name="dom" id="marriage-date" class="form-control" type="text" value="" data-provide="datepicker">
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="blood_group">Blood Group: <span class="text-danger">*</span></label>
										<select name="blood_group" id="blood_group">
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
								<div class="clearfix"></div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="contact">Mobile No1: <span class="text-danger">*</span></label>
										<input name="contact" id="contact" class="form-control" type="text" value="" required="">
										@if($errors->has('contact'))
										<span class="text-danger"><strong>{{ $errors->first('contact')}}</strong></span>
										@endif
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="alt_contact">Mobile No2:</label>
										<input name="alt_contact" id="alt_contact" class="form-control" type="text" value="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="tel">Landline No:</label>
										<input name="tel" id="tel" class="form-control" type="text" value="022">
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="member_type">Member Type: <span class="text-danger">*</span></label>
										<select name="member_type" id="member_type" required="">
											<option selected="" disabled="">Choose Member Type</option>
											<option value="LM">LM</option>
											<option value="PM">PM</option>
											<option value="SW">SW</option>
											<option value="NM">NM</option>
											<option value="OR">OR</option>
										</select>
									</div>
								</div>

							</div>
							<div class="clearfix"></div>
							<div class="text-center">
								<a class="theme_button color2 margin_0 text-center " data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse1">
									<i class="fa fa-angle-double-left"></i> Back
								</a>
								<a class="theme_button color2 margin_0 text-center " data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse3">
									Next <i class="fa fa-angle-double-right"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="panel">
						<div class="regi-head">
							<a data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse3" class="collapsed"><h5>Address & Qualification Details</h5></a>
						</div>
						<div id="faq-collapse3" class="panel-collapse collapse">
							<div class="panel-content">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="email">Email Id:</label>
										<input name="email" id="email" class="form-control input-sm" type="email" value="">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="alt_email">Alternate Email Id:</label>
										<input name="alt_email" id="alt_email" class="form-control input-sm" type="email" value="">
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-4">
									<label for="address">Address 1:</label>
									<textarea class="form-control" rows="3" name="address" id="address" spellcheck="false"></textarea>
								</div>
								<div class="col-sm-4">
									<label for="alt_address">Address 2:</label>
									<textarea class="form-control" rows="3" name="alt_address" id="alt_address" spellcheck="false"></textarea>
								</div>
								<div class="col-sm-4">
									<label for="alt_address2">Address 3:</label>
									<textarea class="form-control input-sm" rows="3" name="alt_address" id="alt_address2" spellcheck="false"></textarea>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-6">
									<label for="city">City :</label>
									<input name="city" id="city" class="form-control" type="text" value="">
								</div>
								<div class="col-sm-6">
									<label for="occupation">Occupation :</label>
									<input name="occupation" id="occupation" class="form-control" type="text" value="">

								</div>
								<div class="clearfix"></div>
								<div class="col-sm-6">
									<label for="qualification_category">Qualification :</label>

										<select name="qualification_category" id="qualification_category" >
											<option value="0">Select an option</option>
											@foreach($qualification_category as $val)
												<option value="{{$val['id']}}">{{$val['name']}}</option>
											@endforeach
										</select>			
									
									

										
		
										<select name="qualification" id="qualification" class="noclass" style="width: 100%;">
											
										</select>

								</div>
								<div class="col-sm-6">
									<label for="company_details">Company Details :</label>
									<textarea class="form-control" rows="4" name="company_details" id="company_details" spellcheck="false"></textarea>
								</div>
								<div class="clearfix"></div>
								<div class="" id="other_qualification-div" style="display: none;">
									<label class="control-label" for="other_qualification"> About Qualification </label>
									<div class="col-sm-12">
										<textarea class="form-control" rows="3" name="other_qualification" spellcheck="false" id="other_qualification"></textarea>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-sm-6">
									<label for="native_address">Native Address :</label>
									<textarea class="form-control input-sm" rows="4" name="native_address" id="native_address" spellcheck="false"></textarea>
								</div>
								<div class="col-sm-6">
									<label for="dist">District :</label>
									<input name="dist" id="dist" class="form-control" type="text" value="">

									<label for="native_pincode">Pincode :</label>
									<input name="native_pincode" id="native_pincode" class="form-control" type="text" value="">
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="text-center topmargin_30">
								<a class="theme_button color2 margin_0 text-center " data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse2">
									<i class="fa fa-angle-double-left"></i> Back
								</a>

								<button type="submit" class="theme_button color2 margin_0 text-center">
									Submit <i class="fa fa-paper-plane"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@endsection

@push('page-script')
<script src="{{ asset('www/js/datepicker.js') }}"></script>
<script>

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
						$("#qualification").append(
							$('<option>', {
				        		value: "{{$val['name']}}",
				        		text : "{{$val['name']}}"
				   			 })
							);
				}
			@endforeach
		}
	});

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

	$("#qualification").change(function() {
		if ( $(this).val() == "Other" ) {
			$("#other_qualification-div").show('slow');
		}
		else {
			$("#other_qualification-div").hide('slow');
		}
	});

	$('#l_name').change(function(){


	var l_name = $(this).find("option:selected").val();

	console.log(l_name);



    if(l_name){
    	$.ajax({
    		type:"GET",
    		url:"{{url('get-khunp-list-website')}}/"+l_name,
    		success:function(res){


    			console.log(res);
    			$('#khanp').val(res.khanp[0]['name']);

    			$("#up_khanp").empty();


    			$.each(res.upkhanp,function(key,value){
    				//$("#up_khanp").append('<option value="'+value.id+'">'+value.name+'</option>');
    				//alert(value.name);
    				$('#up_khanp').append($('<option>', {
				        value: value.id,
				        text : value.name
				    }));


    			});

    		}
    	});
    }
});

// 	$('#member_type').change(function(){
// 		var member_type = $(this).val();
// 		console.log(l_name);
// // alert(l_name);
// if(l_name){
// 	$.ajax({
// 		type:"GET",
// 		url:"{{url('get-member-code-website')}}/"+member_type,
// 		success:function(res){
//
// 			$("#member_code").text("Member Code : "+res);
//
// 		}
// 	});
// }
// });
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
<script>
$(function(){
	$('#up_khanp, #qualification').show();

})
</script>
@endpush
