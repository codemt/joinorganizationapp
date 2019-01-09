@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add Obituary</span>
	</h1>
</div>
<div class="row">
	<div class="col-sm-8">
		<form class="form form-horizontal"  method="post" action="{{ route('obituary.store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
				<div class="form-group">
				<label class="col-sm-3 control-label" for="photo">Upload Photo</label>
				<div class="col-sm-9">
					<input type="file" id="photo" onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])" name="profile_image" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="member">Choose Member</label>
				<div class="col-sm-9">
					<select name="member_id" id="member" class="form-control select">
						@foreach ($member as $key => $member)

				            <option value="{{ $member->id }}">{{ $member->f_name }} {{ $member->l_name }} {{ "(".$member->member_type }}{{ $member->member_code.")" }}</option>

				        @endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="from">Birth Date</label>
				<div class="col-sm-3">
					<div class="input-with-icon">
						<input class="form-control" id="from" type="text" name="birth_date" data-provide="datepicker">
						<span class="icon icon-calendar input-icon"></span>
					</div>
				</div>
				<label class="col-sm-3 control-label" for="to">Died On</label>
				<div class="col-sm-3">
					<div class="input-with-icon">
						<input class="form-control" id="to" type="text" data-provide="datepicker" name="died_on">
						<span class="icon icon-calendar input-icon"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Description">Description</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="description" id="Description"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Description">Description 1</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="description_one" id="Description"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Description">Description 2</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="description_two" id="Description"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Description">Description 3</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="description_three" id="Description"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="obituary_till">Obituary Till</label>
				<div class="col-sm-9">
					<div class="input-with-icon">
						<input class="form-control" id="obituary_till" name="obituary_date" type="text" data-provide="datepicker">
						<span class="icon icon-calendar input-icon"></span>
					</div>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-9">
				<button class="btn btn-outline-primary">
					<i class="icon icon-paper-plane"></i> Submit Details
				</button>
			</div>
		</form>
	</div>
	<div class="col-sm-4">
		<img class="img-responsive" id="image_preview" src="#" alt="">
	</div>
</div>
@endsection
