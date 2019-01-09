 @extends('layouts.master')

 @section('page-content')
 <div class="title-bar">
 	<h1 class="title-bar-title">
 		<span class="d-ib">All Venue</span>
 	</h1>
 </div>
 <div class="row gutter-xs">
 	<div class="col-xs-12">
 		<div class="card">
 			<div class="card-header bg-primary">
 				<div class="card-actions">
 					<button type="button" class="card-action card-toggler" title="Collapse"></button>
 				</div>
 				<strong>Venue List</strong>
 			</div>
 			<div class="card-body">
 				<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
 					<thead>
 						<tr>
 							<th>#</th>
 							<th>Name</th>
 							<th>Contact Number</th>
 							<th>Location</th>
 							<th>Action</th>
 						</tr>
 					</thead>
 					<tbody>

                    <?php $count = 1;?>

					@foreach($venue as $venue1)
					<tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$count++}}</td>
					<td>{{$venue1->name}}</td>
					<td>{{$venue1->contactnumber}}</td>
					<td>{{$venue1->actual_address}}</td>
					<td>

                        <a href="editvenue/{{ $venue1['id'] }}" class="btn btn-outline-success btn-xs" title="Edit Venue" tooltip>
                           <i class="icon icon-edit"></i>
                         </a>

						<button class="btn btn-outline-danger btn-xs" title="Delete Venue" tooltip>
							<i class="icon icon-trash"></i>
						</button>

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
