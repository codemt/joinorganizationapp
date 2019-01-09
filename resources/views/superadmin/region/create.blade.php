@extends('layouts.master')
@push('page-style')
<style media="screen">
	.bootstrap-tagsinput{
		width:100%;
	}
</style>
@endpush
@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add New Region</span>
	</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="demo-form-wrapper">
			@if (session()->has('success'))
	            <div class="alert alert-success alert-dismissible">
	                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                <strong>Error!</strong> {{ Session::get('success') }}
	            </div>
	        @endif
			<form class="form form-horizontal" method="post" action="{{ route('region.store') }}">
				 {{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-3 control-label" for="name">Region Name</label>
					<div class="col-sm-9">
						<input name="name" id="name" class="form-control" type="text" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="pincode">Pincode</label>
					<div class="col-sm-9">
						<input data-role="tagsinput" name="pincode" id="pincode" class="form-control" type="text" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="establishment-date">Establishment Date</label>
					<div class="col-sm-9">
						<input name="establishment_date" id="establishment-date" class="form-control" type="text" value="" data-provide="datepicker" required>
					</div>
				</div>
				{{-- <div class="form-group">
					<label class="col-sm-3 control-label" for="select-member">Select Member</label>
					<div class="col-sm-9">
						<select name="members[]" id="select-member" class="form-control select" multiple="multiple" required>
		        @foreach ($member as $key => $member)

	                <option value="{{ $member->id }}">{{ $member->f_name }} {{ $member->l_name }} {{ "(".$member->member_type }}{{ $member->member_code.")" }}</option>

	            @endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="select-admin">Select Admin</label>
					<div class="col-sm-9">
						<select name="admin" id="select-admin" class="form-control select" required>
				@foreach ($member1 as $key => $member1)

					    <option value="{{ $member1->id }}">{{ $member1->f_name }} {{ $member1->l_name }}  {{ "(".$member1->member_type }}{{ $member1->member_code.")" }} </option>

	            @endforeach
						</select>
					</div>
				</div> --}}
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
