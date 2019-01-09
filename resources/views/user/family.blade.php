@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<div class="col-md-7">
			<span class="d-ib">About Family </span>
		</div>
		<div class="col-md-5">
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Registered_Member">
				Registered Family Member
			</button>
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#Non_Registered_Member">
				Non Registered Family Member
			</button>
		</div>
	</h1>
</div>
<div class="row gutter-xs">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="card-actions">
					<button type="button" class="card-action card-toggler" title="Collapse"></button>
				</div>
				<strong>Family List</strong>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Relation</th>
							<th>Member Code</th>
							<th>Date of Birth</th>
							<th>Blood Group</th>
							<th>Qualification</th>
							<th>Date of Marriage</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
	    		      @foreach($demo1 as $demo1)
						<tr>
							<th>{{$loop->iteration}}</th>
							<th>{{$demo1->relation_member_name}}</th>
							<th>{{$demo1->relation_name}}</th>
							<th>{{$demo1->member_type ?? ''}} {{$demo1->member_code ?? ''}}</th>
							@if($demo1->relation_member_id != null)
							<th>{{date("d/m/Y", strtotime($demo1->member_dob))}}</th>
							<th>{{$demo1->member_blood_group ?? ''}} </th>
							<th>{{$demo1->member_qualification ?? ''}} </th>
							<th>{{$demo1->member_dom ?? ''}} </th>
                            @else
							<th>{{date("d/m/Y", strtotime($demo1->dob))}}</th>
							<th>{{$demo1->blood_group ?? ''}} </th>
							<th>{{$demo1->qualification ?? ''}} </th>
							<th>{{$demo1->dom ?? ''}} </th>
							@endif

							<th>
								<a href="delete_family_member/{{ $demo1->id }}" class="btn btn-outline-danger btn-xs" title="Edit Member" tooltip>
				                    <i class="icon icon-trash"></i>
				                </a>
							</th>
						</tr>
                      @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@push('modals')


<form method="post" action="{{('family_store')}}">
	{{csrf_field()}}
<div id="Registered_Member" tabindex="-1" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Registered Family Member</h4>
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group">
						<label for="search_member" class="form-label">Select Member Code:</label>
						<select id="search_member" class="form-control" name="search_member">
							@foreach($demo as $demo)
					<option value="{{$demo->member_type}}{{$demo->member_code}}">{{$demo->f_name}} {{$demo->m_name}} {{$demo->l_name}} ({{$demo->pincode}})</option>

							@endforeach

						</select>
					</div>
					<div class="form-group">
						<label for="Name" class="form-label">Member Name:</label>
						<input type="text" class="form-control" id="m_name" name="" readonly="">
					</div>
					<div class="form-group">
						<label for="relation" class="form-label">Relation</label>
						<select id="relation" class="form-control" name="relation_name">
							<option value="Son">Son</option>
							<option value="Daughter">Daughter</option>
							<option value="Father">Father</option>
							<option value="Mother">Mother</option>
							<option value="Sister">Sister</option>
							<option value="Brother">Brother</option>
							<option value="Spouse">Spouse</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" name="submit">Continue</button>
					<button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
</form>


<form method="post" action="{{('non_member_family_store')}}">
	{{csrf_field()}}
<div id="Non_Registered_Member" tabindex="-1" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Non Registered Family Member</h4>
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="form-label">Enter Name</label>
						<input type="text" id="name" name="name" class="form-control" required="">
					</div>
					<div class="form-group">
						<label for="dob" class="form-label">Date of Birth</label>
						<div class="input-with-icon">
							<input class="form-control" id="dob" type="text" data-provide="datepicker" data-date-clear-btn="true" name="dob" required="">
							<span class="icon icon-calendar input-icon"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="dob" class="form-label">Date of Marriage</label>
						<div class="input-with-icon">
							<input class="form-control" id="dom" type="text" data-provide="datepicker" data-date-clear-btn="true" name="dom">
							<span class="icon icon-calendar input-icon"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nr_relation" class="form-label">Blood Group</label>
						<select name="blood_group" id="blood_group" class="form-control input-sm">
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
					<div class="form-group">
						<label for="name" class="form-label">Enter Qualification</label>
						<input type="text" id="qualification" name="qualification" class="form-control">
					</div>
					<div class="form-group">
						<label for="nr_relation" class="form-label">Relation</label>
						<select id="nr_relation" class="form-control" name="relation_name">
							<option value="Son">Son</option>
							<option value="Daughter">Daughter</option>
							<option value="Father">Father</option>
							<option value="Mother">Mother</option>
							<option value="Sister">Sister</option>
							<option value="Brother">Brother</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" name="submit">Continue</button>
					<button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
</form>

@endpush

@push('page-script')
<script>

	$(document).ready(function() {
		$("#search_member").select2({
			dropdownParent: $("#Registered_Member")
		});
	});

	$('#search_member').change(function(){
		var s_member = $(this).find("option:selected").val();
		console.log(s_member);
    // alert(l_name);
    if(s_member){
    	$.ajax({
    		type:"GET",
    		url:"{{url('family_data')}}/"+s_member,
    		success:function(res){


    			console.log(res);
    			$('#m_name').val(res);



    		}
    	});
    }
});

</script>
@endpush
