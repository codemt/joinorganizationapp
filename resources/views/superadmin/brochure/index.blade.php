@extends('layouts.master')

@section('page-content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">All Brochures</span>
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
                    <strong>Brochure List</strong>
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
                            @isset($brochures)
                            @foreach ($brochures as $brochure)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $brochure->title}}</td>
                                    <td>{{$brochure->description}}</td>
                                    <td>
                                    <a href="{{route('brochure.edit',$brochure->id)}}" class="btn btn-outline-success btn-xs edit" title="Edit Brochure" tooltip>
                                    <i class="icon icon-edit"></i></a>
                                    <a href="{{route('brochure.show',$brochure->id)}}" class="btn btn-outline-success btn-xs view" title="Download Brochure" tooltip>
                                    <i class="icon icon-download"></i></a>
                                <button type="button" class="btn btn-outline-danger btn-xs delete" title="Delete Region" data-id="{{ $brochure->id }}" tooltip>
                                <i class="icon icon-trash"></i>
                            </button> 
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

@push('page-script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.delete').click(function(){
            var id = $(this).attr('data-id');
            swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this record!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                   $.ajax({
                    url: 'brochure/'+id,
                    type:'post',
                    data:{_method:'DELETE'},
                    success:function(response){
                        console.log(response);
                        swal("Poof! Record deleted successfully!", {
                      icon: "success",
                    });
                        location.reload();
                    }
                   }) 
                    
                });
        })
    </script>
@endpush


