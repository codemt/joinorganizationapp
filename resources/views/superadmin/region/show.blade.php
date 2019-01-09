@extends('layouts.master')
@section('page-content')
<div class="well">
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<h3>
				<div class="row">
					<div class="col-sm-3 text-right text-primary">
						Region :
					</div>
					<div class="col-sm-9">
						FBSS Region
					</div>
				</div>
			</h3>
			<h4>
				<div class="row">
					<div class="col-sm-3 text-right text-primary">
						Admin :
					</div>
					<div class="col-sm-9">
						John Doe
					</div>
				</div>	
				<div class="row">
					<div class="col-sm-3 text-right text-primary">
						Contact No :
					</div>
					<div class="col-sm-9">
						9876543210
					</div>
				</div>
			</h4>
		</div>
		<div class="col-sm-4 col-xs-12">
			<h4>
				<div class="row">
					<div class="col-sm-9 text-right text-primary">
						Total No of Members :
					</div>
					<div class="col-sm-3">
						15
					</div>
				</div>
			</h4>
			<a href="{{ route('Add_Sub_Region') }}" class="btn btn-outline-primary pull-right">
				<i class="icon icon-plus-circle"></i> Add Sub-Region
			</a>
		</div>
	</div>
</div>
<div class="row gutter-xs">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="card-actions">
					<button type="button" class="card-action card-toggler" title="Collapse"></button>
				</div>
				<strong>Sub Regions</strong>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Region Head</th>
							<th>Contact No.</th>
							<th>No. of Members</th>
							<th>Establishment Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>FBSS</td>
							<td>John Doe</td>
							<td>98976543210</td>
							<td>10</td>
							<td>12/12/18</td>
							<td>
								<a href="" class="btn btn-outline-primary btn-xs" title="View Sub Region" tooltip>
									<i class="icon icon-eye"></i>
								</a>
								<a class="btn btn-outline-success btn-xs" title="Edit Sub Region" tooltip>
									<i class="icon icon-edit"></i>
								</a>
								<button class="btn btn-outline-danger btn-xs" title="Delete Sub Region" tooltip>
									<i class="icon icon-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row gutter-xs">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header bg-primary">
				<div class="card-actions">
					<button type="button" class="card-action card-toggler" title="Collapse"></button>
				</div>
				<strong>Members List</strong>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>FBSS</td>
							<td>12/12/18</td>
							<td>
								<a href="" class="btn btn-outline-primary btn-xs" title="View Member" tooltip>
									<i class="icon icon-eye"></i>
								</a>
								<a class="btn btn-outline-success btn-xs" title="Edit Member" tooltip>
									<i class="icon icon-edit"></i>
								</a>
								<button class="btn btn-outline-danger btn-xs" title="Delete Member" tooltip>
									<i class="icon icon-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection