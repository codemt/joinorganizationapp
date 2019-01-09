@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add New Admin</span>
	</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="demo-form-wrapper">
			<form class="form form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label" for="l_name">Last Name</label>
					<div class="col-sm-9">
						<input id="l_name" class="form-control" type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="f_name">First Name</label>
					<div class="col-sm-9">
						<input id="f_name" class="form-control" type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="m_name">Middle Name</label>
					<div class="col-sm-9">
						<input id="m_name" class="form-control" type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="email">Enter Email</label>
					<div class="col-sm-9">
						<input id="email" class="form-control" type="email" value="">
						<p class="help-block">
							<small>Admin Login Id</small>
						</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="password">Set Password</label>
					<div class="col-sm-9">
						<input id="password" class="form-control" type="password" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="cpassword">Confirm Password</label>
					<div class="col-sm-9">
						<input id="cpassword" class="form-control" type="password" value="">
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