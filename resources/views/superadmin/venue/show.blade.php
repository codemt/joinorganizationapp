@extends('layouts.master')
@section('page-content')
<div class="well">
	<div class="row">
		<div class="col-sm-8 col-xs-12">
			<h3>
				<div class="row">
					<div class="col-sm-3 text-right text-primary">
						Locaion :
					</div>
					<div class="col-sm-9">
						FBSS 
					</div>
				</div>
			</h3>
		
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
			<a href="#" class="btn btn-outline-primary pull-right">
				<i class="icon icon-file-text-o"></i> Export To Excel
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
				<strong>All Past Booking</strong>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Time</th>
							<th>Event Name</th>
							<th>Regin Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>12/12/18</td>
						    <td>10:45 AM</td>
							<td>John Doe</td>
							<td>Xyz</td>
							<td class="text-center">
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

@endsection