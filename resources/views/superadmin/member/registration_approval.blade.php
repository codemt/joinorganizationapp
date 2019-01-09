@extends('layouts.master')

@section('page-content')
  <div class="title-bar">
    <h1 class="title-bar-title">
      <span class="d-ib">Approve Updates</span>
    </h1>
  </div>
<div class="row gutter-xs">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header bg-primary">
        <div class="card-actions">
          <button type="button" class="card-action card-toggler" title="Collapse"></button>
        </div>
        <strong>Update Approvals</strong>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Member Name</th>
              <th>Pincode</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $i = 1;
            @endphp
            <?php foreach ($output as $output)  {?>
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $output->f_name }} {{ $output->l_name }}</td>
              <td>{{ $output->pincode }}</td>
              <td>
                <a href="registration_profile_view/{{ $output->id }}" target="_blank" class="btn btn-outline-success btn-xs" title="View Changes" tooltip>
                 <i class="icon icon-eye"></i>
                </a>
                @if (Auth::user()["role"] == 0)
                    <a href="approve_registration_super_admin/{{ $output->id }}" class="btn btn-outline-success btn-xs" title="Approve Changes" tooltip>
                     <i class="icon icon-check"></i>
                    </a>
                @else
                    <a href="approve_registration_region_admin/{{ $output->id }}" class="btn btn-outline-success btn-xs" title="Approve Changes" tooltip>
                     <i class="icon icon-check"></i>
                    </a>
                @endif

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
