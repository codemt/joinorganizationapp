 @extends('layouts.master')

 @section('page-content')
 <div class="title-bar">
    <h1 class="title-bar-title">
        <span class="d-ib">Gallery</span>
    </h1>
</div>
<div class="row gutter-xs">

    <div class="col-xs-12">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                </div>
                <strong>Gallery List</strong>
            </div> 
            <div class="card-body">                
                <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                        <tr>                            
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gallery as $gallery)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $gallery->title }}
                            </td>
                            <td>
                                {{ $gallery->description }}
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-success btn-xs edit" title="Edit Member" tooltip>
                                    <i class="icon icon-edit"></i>
                                </a>
                                <a href="{{route('gallery.show',$gallery->id)}}" class="btn btn-outline-success btn-xs view" title="View Member" tooltip>
                                    <i class="icon icon-eye"></i>
                                </a>
                                {{-- <button class="btn btn-outline-warning btn-xs sms" title="SMS Member" tooltip>
                                    <i class="icon icon-envelope-o"></i>
                                </button> 
                                <button type="button" class="btn btn-xs btn-outline-danger delete" data-toggle="tooltip" data-id="{{ $gallery->id }}" title="Delete Member">
                                    <i class="icon icon-trash"></i>
                                </button>
                                --}}
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
{{-- <script>
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
</script> --}}
@endpush
