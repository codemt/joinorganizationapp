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
			<form class="form form-horizontal" method="post" action="{{route('region.update',$regions->id)}}">
				 {{ csrf_field() }}
				 {{ method_field('PATCH') }}
				<div class="form-group">
					<label class="col-sm-3 control-label" for="name">Region Name <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<input name="name" id="name" class="form-control" value="{{$regions->name}}" type="text" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="pincode">Pincode</label>
					<div class="col-sm-9">
						<input data-role="tagsinput" name="pincode" id="pincode" class="form-control" type="text" value="{{$regions->pincode}}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="establishment-date">Establishment Date <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<input name="establishment_date" id="establishment-date" class="form-control" type="text" value="{{date('d-m-Y', strtotime($regions->establishment_date))}}" data-provide="datepicker" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="select-admin">Select Admin <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<select name="admin" id="select-admin" class="form-control select"  required>
				@isset($admins)
				@foreach ($admins as $key => $admin)

					    <option value="{{ $admin->id }}" {{($regions->admin == $admin->id)?'selected':''}}>{{ $admin->f_name }} {{ $admin->l_name }} {{ "(".$admin->member_type }}{{ $admin->member_code.")" }} </option>

	            @endforeach
				@endisset
						</select>
					</div>
				</div>
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
