@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Update Profile</span>
	</h1>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Success!</strong>  Updated Successfully.
</div>
@endif


@if ($member->member_update_regional != null || $member->member_update_super_admin != null)
<div class="alert alert-success alert-dismissible">
	Approval For Update is Pending
</div>
@endif

<!-- <div class="row">
	<div class="col-md-8">
		<div class="demo-form-wrapper">
			<form class="form form-horizontal" name="update_password"  method="post" action="{{ route('update_password') }}" onsubmit="return Validate()">
				{{ csrf_field() }}

			</form>
		</div>
	</div>
</div> -->

<div class="row">


	<form class="form form-horizontal" method="post" action="{{route('user_profile_update')}}" enctype="multipart/form-data" onsubmit="return check_no();">
		{{ csrf_field() }}
		<input type="hidden" name="user_id" value="{{$member->user_id}}">
		<input type="hidden" name="id" value="{{$member->id}}">
		<div class="col-sm-9">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="password">Set New Password</label>
				<div class="col-sm-9">
					<input id="password" name="password" class="form-control" type="password" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="cpassword">Confirm Password</label>
				<div class="col-sm-9">
					<input id="cpassword" name="cpassword" class="form-control" type="password" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="photo">Upload Photo</label>
				<div class="col-sm-9">
					<input type="file" id="photo" onchange="document.getElementById('image_preview').src =window.URL.createObjectURL(this.files[0])" name="profile_image" class="form-control" accept="image/x-png,image/gif,image/jpeg">
				</div>
			</div>
		</div>

		<div class="col-sm-3">
			<img class="img-responsive" id="image_preview" src="{{asset($member->profile_photo)}}" alt="" style="width: 90px;height: 90px;">
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
							<?php $salutations = array("Mr.", "Ms.", "Mrs.","Master", "Shri", "Smt.","Dr.");  ?>
							<select name="salutation" class="form-control input-sm">


								@foreach($salutations as $sal)
								@if ($member->salutation == $sal)
								<option selected="selected" value="{{$sal}}">{{$sal}}</option>
								@else
								<option value="{{$sal}}">{{$sal}}</option>
								@endif
								@endforeach


							</select>
						</div>
						<div class="col-sm-2">
							<select name="l_name" id="l_name" class="form-control input-sm" disabled>

								@foreach($surname as $data)
								@if($member->l_name == $data->name)
								<option selected="selected" value="{{$data->name}}" data-id="{{$data->id}}" disabled>{{$data->name}}</option>
								@else
								<option value="{{$data->name}}" data-id="{{$data->id}}" disabled>{{$data->name}}</option>
								@endif
								@endforeach

							</select>

						</div>
						<div class="col-sm-2">
							<input name="f_name" value="{{$member->f_name}}" class="form-control input-sm" type="text" placeholder="First Name" required="">
						</div>
						<div class="col-sm-2">
							<input name="m_name"  value="{{$member->m_name}}" class="form-control input-sm" type="text" placeholder="Father / Husband Name" required="">
						</div>
						<div class="col-sm-2">
							<input name="mother_name" value="{{$member->mother_name}}" class="form-control input-sm" type="text" placeholder="Mother's Name" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="dob">Date of Birth <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<input name="dob" class="form-control input-sm" id="dob" type="text" data-provide="datepicker" required="" value="{{date("d/m/Y", strtotime($member->dob))}}">
						</div>
						<label class="col-sm-2 control-label" for="">Gender</label>
						<div class="col-sm-6">
							<div class="md-form-group custom-controls-stacked">

								@if($member->gender == "Male")
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
								@else
								<div class="col-sm-4">
									<label class="custom-control custom-control-primary custom-radio">
										<input class="custom-control-input" type="radio" name="gender" value="Male">
										<span class="custom-control-indicator"></span>
										<span class="custom-control-label">Male</span>
									</label>
								</div>
								<div class="col-sm-4">
									<label class="custom-control custom-control-primary custom-radio">
										<input class="custom-control-input" type="radio" name="gender" value="Female" checked="checked">
										<span class="custom-control-indicator"></span>
										<span class="custom-control-label">Female</span>
									</label>
								</div>
								@endif


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
						<label class="col-sm-2 control-label" for="khanp">Khanp <span class="text-danger">*</span></label>

						<div class="col-sm-4">
							<input name="khanp" id="khanp" class="form-control input-sm" type="text" placeholder="First Name" required="" disabled>
						</div>

						<label class="col-sm-2 control-label" for="up_khanp">UpKhanp</label>
						<div class="col-sm-4">
							<select class="form-control input-sm" name="up_khanp" id="up_khanp">

							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="marital_status">Marital Status</label>
						<div class="col-sm-2">
							<select class="form-control input-sm" name="marital_status" id="marital_status">
								<?php $marraige_status = array("Single", "Married", "Divorced","Widow");  ?>
								@foreach($marraige_status as $data1)
								@if($data1 == $member->marital_status)
								<option value="{{$data1}}" selected="selected">{{$data1}}</option>
								@else
								<option value="{{$data1}}">{{$data1}}</option>
								@endif
								@endforeach

							</select>
						</div>
						<div id="marriage-date-div">
							<label class="col-sm-2 control-label" for="marriage-date">Date of Marriage </label>
							<div class="col-sm-2">
								<input name="dom" id="marriage-date" class="form-control input-sm" type="text" value="{{date("d/m/Y", strtotime($member->dom))}}" data-provide="datepicker">
							</div>
						</div>
						<label class="col-sm-2 control-label" for="blood_group">Blood Group <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<select name="blood_group" id="blood_group" class="form-control input-sm" required="">
								<?php $blood_group = array("A +", "A -", "AB +","AB -","B +", "B -", "O +","O -", "B","N.A.");  ?>
								@foreach($blood_group as $data2)
								@if($data2 == $member->blood_group)
								<option value="{{$data2}}" selected="selected">{{$data2}}</option>
								@else
								<option value="{{$data2}}">{{$data2}}</option>
								@endif
								@endforeach
							</select>
						</div>



					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="contact">Mobile No:1 <span class="text-danger">*</span></label>
						<div class="col-sm-2">
							<input name="contact" id="contact" class="form-control input-sm" type="text" required="" value="{{$member->contact}}">
							@if($errors->has('contact'))
							<span class="text-danger"><strong>{{ $errors->first('contact')}}</strong></span>
							@endif

						</div>
						<label class="col-sm-2 control-label" for="alt_contact">Mobile No:2 </label>
						<div class="col-sm-2">
							<input name="alt_contact" id="alt_contact" class="form-control input-sm" type="text" value="{{$member->alt_contact}}">
						</div>
						<label class="col-sm-2 control-label" for="tel">Landline No. </label>
						<div class="col-sm-2">
							<input name="tel" id="tel" class="form-control input-sm" type="text" value="{{$member->tel}}">
						</div>
					</div>

					<label class="col-sm-2 control-label" for="contact"> Member Type <span class="text-danger">*</span></label>

					<div class="col-sm-4">
						<select name="member_type" class="form-control input-sm" id="member_type" required="" disabled>
							<?php $member_type = array("LM", "PM", "SW","NM","OR");  ?>
							@foreach($member_type as $data3)
							@if($data3 == $member->member_type)
							<option value="{{$data3}}" selected="selected">{{$data3}}</option>
							@else
							<option value="{{$data3}}">{{$data3}}</option>
							@endif
							@endforeach
						</select>
					</div>
                  	<label class="col-sm-2 control-label" id="member_code"> Member Code : {{$member->member_type}} {{$member->member_code}}</label>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="card" aria-expanded="true">
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
							<input name="email" id="email" class="form-control input-sm" type="email" value="{{$member->email}}">
						</div>
						<label class="col-sm-2 control-label" for="alt_email">Alternate Email Id. </label>
						<div class="col-sm-4">
							<input name="alt_email" id="alt_email" class="form-control input-sm" type="email" value="{{$member->alt_email}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="address">Address:1</label>
						<div class="col-sm-2">
							<textarea class="form-control input-sm" rows="1" name="address" id="address" spellcheck="false"> {{$member->address}}</textarea>
						</div>
						<label class="col-sm-2 control-label" for="alt_address">Address:2</label>
						<div class="col-sm-2">
							<textarea class="form-control input-sm" rows="1" name="alt_address" id="alt_address" spellcheck="false">{{$member->alt_address}}</textarea>
						</div>
						<label class="col-sm-2 control-label" for="alt_city">State</label>
						<div class="col-sm-2">
							<textarea class="form-control input-sm" rows="1" name="alt_city" id="alt_city" spellcheck="false">{{$member->alt_city}}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="city">City</label>
						<div class="col-sm-4">
							<input name="city" id="city" class="form-control input-sm" type="text" value="{{$member->city}}">
						</div>
						<label class="col-sm-2 control-label" for="pincode">Pincode <span class="text-danger">*</span></label>
						<div class="col-sm-4">
							<input name="pincode" id="pincode" class="form-control input-sm" type="text" value="{{$member->pincode}}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="occupation">Occupation </label>
						<div class="col-sm-2">
							<input name="occupation" id="occupation" class="form-control input-sm" type="text" value="{{$member->occupation}}">
						</div>
						<label class="control-label col-sm-2" for="company_details">Company Details </label>
						<div class="col-sm-2">
							<textarea class="form-control input-sm" rows="1" name="company_details" id="company_details" spellcheck="false">{{$member->company_details}}</textarea>
						</div>
						<label class="control-label col-sm-2" for="qualification">Qualification </label>
						<div class="col-sm-2">
							<select name="qualification_category" id="qualification_category" class="form-control input-sm">
								
							</select>		
							<?php $id = ""; ?>
							<select name="qualification" id="qualification" class="form-control input-sm">
								<option value=" ">Select Qualification</option>
								<?php $temp1 = $qualification; ?>
								@foreach($qualification as $data3)
								@if($data3['name'] == $member->qualification)
								<?php $id = $data3['category']; ?>
								<option value="{{$data3['name']}}" selected="selected">{{$data3['name']}}</option>
								@endif
								@endforeach

								@foreach($temp1 as $data3)
								@if($data3['name'] != $member->qualification && $data3['category'] == $id)
								<option value="{{$data3['name']}}">{{$data3['name']}}</option>
								@endif
								@endforeach
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
							<textarea class="form-control input-sm" rows="1" name="native_address" id="native_address" spellcheck="false">{{$member->native_address}}</textarea>
						</div>
						<label class="col-sm-2 control-label" for="dist">District</label>
						<div class="col-sm-2">
							<input name="dist" id="dist" class="form-control" type="text" value="{{$member->dist}}">
						</div>
						<label class="col-sm-2 control-label" for="native_pincode">Pincode</label>
						<div class="col-sm-2">
							<input name="native_pincode" id="native_pincode" class="md-form-control" type="text" value="{{$member->native_pincode}}">
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
	function Validate(){

		var x=document.forms["update_password"]["password"].value;
		var y=document.forms["update_password"]["cpassword"].value;
		var isValid = true;

		if(x!=y){
			alert("Password is not matching");
			isValid =  false;

		}

		if(x.toString().length <6)
		{
			alert("Password should be greater than 6 words");
			isValid =  false;
		}

		return isValid;
	}


</script>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>


<script type="text/javascript">
	var members = [];

	<?php $quali = $qualification; ?>
	@foreach($qualification_category as $val)
	   var category = {{$id}};
	   var temp = {{$val['id']}};
	   if(category == temp)
	   {
			$("#qualification_category").append('<option value="{{$val['id']}}" selected="">{{trim($val['name'])}}</option>');
	   }
	   else
	   {
   			$("#qualification_category").append('<option value="{{$val['id']}}">{{trim($val['name'])}}</option>');
	   }
	@endforeach

	$("#qualification_category").change(function() {
		$("#qualification").html("");

		var ele = $(this);

		if ( $(this).val() == "0" ) 
		{

		}
		else 
		{
			@foreach($qualification as $val)
				var id = {{$val['category']}};
				if(id == ele.val())
				{
						$("#qualification").append('<option value="{{$val['name']}}">{{$val['name']}}</option>');
				}
			@endforeach
		}
	});

	@foreach($members6 as $members2)
		@if($members2->id != $member->id)
		members.push('{{$members2->contact}}');
		@endif
	@endforeach
	
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


$('#dob').datepicker({
		startDate: '-125y',
		endDate: '0'
	}).on('changeDate', function (ev) {

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

		$.ajax({
			type:"GET",
			url:"{{url('get-khunp-list')}}/"+$("#l_name").find("option:selected").attr("data-id"),
			success:function(res){


				console.log(res);
				$('#khanp').val(res.khanp[0]['name']);

				$("#up_khanp").empty();

				<?php $up_khanp = $member->up_khanp==null?'':$member->up_khanp;?>
				@if($up_khanp == '')
				$("#up_khanp").append('<option value="" disabled selected="selected">Select an Upkhanp</option>');
				@endif

				$.each(res.upkhanp,function(key,value){
					if('{{$up_khanp}}' == value.id)
					{
						$("#up_khanp").append('<option value="'+value.id+'" selected="selected">'+value.name+'</option>');
					}
					else
					{
						$("#up_khanp").append('<option value="'+value.id+'">'+value.name+'</option>');
					}

				})

			}
		});


	function check_no()
	{

        if($("#password").val().length !== 0 && $("#password").val().length <6)
        {
			alert("Password should be minimum of 6 characters");
			return false;
        }

        var x=$("#password").val();
		var y=$("#cpassword").val();

		if(x!=y)
		{
			alert("Password is not matching");
			return false;
		}

		if($.inArray($("#contact").val(), members) !== -1)
		{
			alert("Already linked to other member. Check your mobile No. Email to Info @mpmmumbai.in stating your LM code, name n mobile no.");
			return false;
		}

		return true;
	}

</script>

@endpush
