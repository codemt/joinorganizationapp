@extends('layouts.master')

@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<div class="col-md-7">
			<span class="d-ib">Family details of {{$member_name}} </span>
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
						</tr>
                      @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
