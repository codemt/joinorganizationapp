@extends('layouts.master')

@section('page-content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">All Region</span>
        </h1>
    </div>
    <div class="row gutter-xs">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @endif
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-actions">
                        <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    </div>
                    <strong>Regions List</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>No of Members</th>
                                <th>Admin Name</th>
                                <th>Establishment Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($regions as $region)  {?>
                                <tr>
                                    <td></td>
                                    <td>{{ $region['name'] }}</td>
                                    <td>
                                        {{ sizeof($region['members_array']) }}
                                    </td>
                                    <td>{{ $region['admin_name'] }}</td>
                                    <td>{{ $region['establishment_date'] }}</td>
                                    <td>
                                        <?php  $region['members'] = json_decode($region['members']);?>
                                        <p class="region hide">{{ json_encode($region) }}</p>
                                        <a class="btn btn-outline-primary btn-xs members" title="Manage Members" tooltip>
                                            <i class="icon icon-eye"></i>
                                        </a>
                                    {{-- <a href="editregion/{{ $region['id'] }}" class="btn btn-outline-success btn-xs edit" title="Edit Region" tooltip>
                                    <i class="icon icon-edit"></i>
                                    </a> --}}
                                        {{--  <a class="btn btn-outline-primary btn-xs" title="View Region" tooltip>
                                        <i class="icon icon-eye"></i>
                                    </a>
                                    <a href="{{ route('region.edit', $region->id) }}" class="btn btn-outline-success btn-xs" title="Edit Region" tooltip>
                                    <i class="icon icon-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-xs delete" title="Delete Region" data-id="{{ $region->id }}" tooltip>
                                <i class="icon icon-trash"></i>
                            </button> --}}
                        </td>
                    </tr>
                    <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@push('page-script')
    <script>

    var id = "";

    $(document).on('click', '.members', function(){

        var sample = $(this).parent().find(".region").text();

        data = JSON.parse(sample);

        id = data.id;

        var member_id = $.map(data.members, function(el) { return el; });

        $('#member_list').DataTable().clear().draw();
        $.each(data.members_array, function (key, value) {

            $('#member_list').DataTable().row.add([
                value
            ]).draw();

        });



        $('#member').empty();
        @foreach ($member as $key => $member)
             var temp = {{$member->id}};
             if(jQuery.inArray(temp.toString(), member_id) == -1)
             {

                  $('#member').append(
                      ` <option value="{{ $member->id }}">{{ $member->f_name }} {{ $member->l_name }}</option>`
                  );
             }
        @endforeach

        $('#myModal').modal('show');

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

    $(document).on('click', '#add_member', function(){

        $.ajax({
                         url: "{{ route('add_member_to_region') }}",
                         method: "POST",
                         data: {
                             'member_id' : $('#member').val(),
                             'region_id' : id
                           },
                         cache: false,
                         success: function(html){

                            alert("member added successfully");

                            location.reload();

                        }
               });

    });

    $(document).on('click', '.delete', function(){
        let id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url:'/region/'+ id,
                    type:'post',
                    data:{_method:'delete',_token:'{{ csrf_token() }}'},
                    success : function(response) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                        $( ".dataTable" ).load( "/region .dataTable" );
                    }
                })
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });


    $(document).ready( function () {$('#member_list').dataTable( {
        "bDestroy": true,
        "bSort": false
    } );
} );
</script>
@endpush
@push('modals')
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">List of Members</h4>
                </div>
                <div class="modal-body">

                        {{-- <select id="member" class="form-control select">

                        </select>
                        <br>
                        <div class="col-sm-offset-3 col-sm-9 ">
                            <button class="btn btn-outline-primary pull-right" id="add_member">
                                <i class="icon icon-paper-plane"></i> Add member
                            </button>
                        </div>

                    <hr> --}}

                    <table id="member_list" class="table  table-condensed table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:90%">Members</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>


                    </div>

                </div>

            </div>
        </div>
    @endpush
