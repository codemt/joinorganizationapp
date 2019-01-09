 @extends('layouts.master')

 @section('page-content')
 <div class="title-bar">
 	<h1 class="title-bar-title">
 		<span class="d-ib">All Events</span>
 	</h1>
 </div>
 <div class="row gutter-xs">
 	<div class="col-xs-12">
 		<div class="card">
 			<div class="card-header bg-primary">
 				<div class="card-actions">
 					<button type="button" class="card-action card-toggler" title="Collapse"></button>
 				</div>
 				<strong>Events List</strong>
 			</div>
 			<div class="card-body">

 				<table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
 					<thead>
 						<tr>
 							<th>#</th>
 							<th>Event Name</th>
 							<th>Venue</th>
 							<th>Location</th>
 							<th>Date & Time</th>
 							<th>Action</th>
 						</tr>
 					</thead>
 					<tbody>
                        <?php $count = 1;?>

                        @foreach($event as $event1)
                        <?php

                        $start_time = json_decode($event1['timing']);

                        ?>
					<tr>
                    <td>{{$count++}}</td>
					<td>{{$event1['name']}}</td>
					<td>{{$event1['venue_name']}}</td>
					<td>{{$event1['venue_address']}}</td>
					<td>{{$start_time[0]->start_date}} {{$start_time[0]->start_time}}</td>
					<td>
                        <?php  $event1['interested'] = json_decode($event1['interested']);?>
                        <p class="event hide">{{ json_encode($event1) }}</p>
                        <a class="btn btn-outline-primary btn-xs events" title="Interested Members" tooltip>
                            <i class="icon icon-eye"></i>
                        </a>
                        <a href="editevent/{{ $event1['id'] }}" class="btn btn-outline-success btn-xs edit" title="Edit Event" tooltip>
                        <i class="icon icon-edit"></i>
                        </a>
 								{{-- <a class="btn btn-outline-primary btn-xs" title="View More" tooltip>
 									<i class="icon icon-eye"></i>
 								</a>
 								<a class="btn btn-outline-success btn-xs" title="Edit Region" tooltip>
 									<i class="icon icon-edit"></i>
 								</a>
 								<button class="btn btn-outline-danger btn-xs" title="Delete Region" tooltip>
 									<i class="icon icon-trash"></i>
 								</button> --}}
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
 @push('page-script')
 <script>
 	let column_num = parseInt( $(this).parent().index());

 	$("#checkAll").click(function() {
 		if($('.check-row').click()) {
 			if ($(this).is(":checked")) {
     //$('input:checkbox').not(this).prop('checked', this.checked);
     $(".edit").hide();
 }
 else {
 	$(".edit").show();
 }
}
});

$(document).on('click', '.events', function(){

    var sample = $(this).parent().find(".event").text();

    data = JSON.parse(sample);

    id = data.id;

    $('#member_list').DataTable().clear().draw();
    $.each(data.members_array, function (key, value) {
        var count = key+1;
        $('#member_list').DataTable().row.add([
            count,value
        ]).draw();

    });

    $('#myModal').modal('show');

});

</script>
@endpush
@push('modals')
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">List of Interested Members for event</h4>
                </div>
                <div class="modal-body">

                    <table id="member_list" class="table  table-condensed table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th style="width:90%">Members</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>


                    </div>

                </div>

            </div>
        </div>
    @endpush
