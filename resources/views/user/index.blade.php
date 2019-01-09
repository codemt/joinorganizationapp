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

               {{-- <div class="row">
                   <div class="form-group">
                       <div class="col-sm-2 col-sm-offset-1">
                           <label>From Date</label>
                           <input class="form-control" type="text" data-provide="datepicker" placeholder="Enter Name">
                       </div>
                       <div class="col-sm-2">
                           <label>To Date</label>
                           <input class="form-control" type="text" data-provide="datepicker" placeholder="Enter Name">
                       </div>
                       <div class="col-sm-2">
                           <label>By Venue</label>
                           <select class="form-control">
                               <option value="">Venue 1</option>
                               <option value="">Venue 11</option>
                               <option value="">Venue 111</option>
                           </select>
                       </div>
                       <div class="col-sm-2">
                           <label class="m-t-lg custom-control custom-control-primary custom-checkbox">
                               <input class="custom-control-input" type="checkbox" name="" value="">
                               <span class="custom-control-indicator"></span>
                               <span class="custom-control-label">Upcoming Events</span>
                           </label>
                       </div>
                       <div class="col-sm-2">
                           <button type="button" class="m-t-md btn btn-outline-primary btn-block">
                               <i class="icon icon-filter"></i> Filter Data
                           </button>
                       </div>
                   </div>
               </div>
               <hr/> --}}
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

                       @foreach($event as $event1)
                       <?php

                       $start_time = json_decode($event1->timing);
                       $interest = json_decode($event1->interested);


                       ?>
                   <tr>
                   <td>1</td>
                   <td>{{$event1->name}}</td>
                   <td>{{$event1->venue_name}}</td>
                   <td>{{$event1->address}}</td>
                   <td>{{$start_time[0]->start_date}} {{$start_time[0]->start_time}}</td>
                   <td>
                       @if (($key = array_search($member_id, $interest)) === false)
                           <button data-id="{{$event1->id}}" class="btn btn-outline-success btn-xs interest" title="I'm Interested" tooltip>
                                  <i class="icon icon-check"></i> Interested
                           </button>
                       @endif

                       @if (($key = array_search($member_id, $interest)) !== false)
                           <button data-id="{{$event1->id}}" class="btn btn-outline-danger btn-xs not_interest" title="I'm Not Interested" tooltip>
                                    <i class="icon icon-check"></i> Not Interested
                            </button>
                       @endif

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

$(document).on('click', '.remove_members', function(){
    var member_id = $(this).attr('data-id');

    swal({
        title: "Are you sure?",
        text: "Do you want to remove this member",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {

            $.ajax({
                             url: "{{ route('remove_member_from_region') }}",
                             method: "POST",
                             data: {
                                 'member_id' : member_id,
                                 'region_id' : id
                               },
                             cache: false,
                             success: function(html){

                                alert("member removed successfully");

                                location.reload();

                            }
                   });
        } else {
            swal("Your imaginary file is safe!");
        }
    });

});

$(document).on('click', '.interest', function(){

    var event_id = $(this).attr("data-id");

    $.ajax({
                     url: "{{ route('interested_in_event') }}",
                     method: "POST",
                     data: {
                         'event_id' : event_id
                       },
                     cache: false,
                     success: function(html){

                        alert("Your Interest Added!");

                        location.reload();

                    }
           });

});

$(document).on('click', '.not_interest', function(){

    var event_id = $(this).attr("data-id");

    $.ajax({
                     url: "{{ route('remove_interested_in_event') }}",
                     method: "POST",
                     data: {
                         'event_id' : event_id
                       },
                     cache: false,
                     success: function(html){

                        alert("Interest Removed!");

                        location.reload();

                    }
           });

});

</script>
@endpush
