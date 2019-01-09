@extends('layouts.master')

@section('page-content')
  <div class="title-bar">
    <h1 class="title-bar-title">
      <span class="d-ib">All Samiti</span>
    </h1>
  </div>
<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header bg-primary">
        <div class="card-actions">
          <button type="button" class="card-action card-toggler" title="Collapse"></button>
        </div>
        <strong>Samiti List</strong>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Samiti Year</th>
              <th>Valid till</th>
              <th>Total Members</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $i = 1;
            @endphp
            <?php foreach ($samiti as $sam)  {?>
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $sam['name'] }}</td>
              <td>{{ $sam['samiti_year'] }}</td>
              <td>{{ $sam['valid_till'] }}</td>
              <td>{{ $sam['members_no'] }}</td>
              <td>
                <a href="editsamiti/{{ $sam['id'] }}" class="btn btn-outline-success btn-xs" title="Edit samiti" tooltip>
                 <i class="icon icon-edit"></i>
               </a>

             </td>
           </tr>
           <?php }?>
         </tbody>
       </table>
     </div>
   </div>
 </div>
   </div>
@endsection
