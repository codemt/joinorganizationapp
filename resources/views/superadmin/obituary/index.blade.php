 @extends('layouts.master')

 @section('page-content')
 <div class="title-bar">
 	<h1 class="title-bar-title">
 		<span class="d-ib">All Obituary</span>
 	</h1>
 </div>
 <div class="row gutter-xs">
 	<div class="col-xs-12">
 		<div class="card">
 			<div class="card-header bg-primary">
 				<div class="card-actions">
 					<button type="button" class="card-action card-toggler" title="Collapse"></button>
 				</div>
                <strong>Obituary</strong>
 			</div>
 			<div class="card-body">


 					<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
 					<thead>
 						<tr>
 							<th>#</th>
 							<th>Member Name</th>
 							<th>Expiry Date</th>
 							<th>Obituary Date</th>
 							<th>Description</th>
 							<th>Action</th>
 						</tr>
 					</thead>
 					<tbody>
                        @foreach($obituary as $obituary)
    					<tr>
                        <td>{{ $loop->iteration }}</td>
    					<td>{{$obituary->member->f_name}} {{$obituary->member->l_name}}</td>
    					<td>{{$obituary->died_on}}</td>
    					<td>{{$obituary->obituary_date}}</td>
                        <td>{{$obituary->description}}</td>
                    	<td>



    					</td>
    					</tr>
    					@endforeach
 					</tbody>
 				</table>
 			</div>
 		</div>
 	</div>
 </div>
 @endsection
