 @extends('layouts.master')

 @section('page-content')
 <div class="title-bar">
    <h1 class="title-bar-title">
        <span class="d-ib">All Member</span>
    </h1>
</div>
<div class="row gutter-xs">
    @if( Session::has('success'))
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
                <strong>Member List</strong>
            </div>
            <div class="card-body">
                 <table class="table table-bordered" id="category_table">
                    <thead>
                        <tr>
                            <th>
                                <label class="custom-control custom-control-primary custom-checkbox">
                                    <input class="custom-control-input" id="checkAll" type="checkbox" name="" value="">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-label">Select All</span>
                                </label>
                            </th>
                            <th>Name</th>
                            <th>Contact No.</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Member Code</th>
                            <th>Pincode</th>
                            <th>Region</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script>
let table;
 table = $('#category_table').DataTable({
            'language':{
                "loadingRecords": "&nbsp;",
                "processing": "Loading Members...",
                "zeroRecords": " " 
            },
            'mark':true,
            "ajax": {
                "url" : "{{route('get_member_by_page')}}",
                "type" : "POST",
                'data' : function(d){
                }
            },
            "processing": true,
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": [0]
            }]
        });
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
  
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
                    url:'/member/'+ id,
                    type:'post',
                    data:{_method:'delete',_token:'{{ csrf_token() }}'},
                    success : function(response) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                        $( ".dataTable" ).load( "/member .dataTable" );
                    }
                })
            } else {

            }
        });
    });
</script>
@endpush
