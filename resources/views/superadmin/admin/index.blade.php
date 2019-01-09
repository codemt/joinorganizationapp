 @extends('layouts.master')

 @section('page-content')
 <div class="title-bar">
  <h1 class="title-bar-title">
    <span class="d-ib">All Admin</span>
  </h1>
</div>

<div class="panel m-b-lg">
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="#active" data-toggle="tab">Active Admins</a></li>
    <li><a href="#inactive" data-toggle="tab">Inactive Admins</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade active in" id="active">
      <div class="row gutter-xs">
        <div class="col-xs-12">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="card-actions">
                <button type="button" class="card-action card-toggler" title="Collapse"></button>
              </div>
              <strong>Active Admins</strong>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Region Head</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Tiger</td>
                    <td>John</td>
                    <td>
                      <a href="{{ route('Show_Admin') }}" class="btn btn-outline-primary btn-xs" title="View Admin" tooltip>
                        <i class="icon icon-eye"></i>
                      </a>
                      <a class="btn btn-outline-success btn-xs" title="Edit Admin" tooltip>
                        <i class="icon icon-edit"></i>
                      </a>
                      <button class="btn btn-outline-danger btn-xs" title="Delete Admin" tooltip>
                        <i class="icon icon-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="inactive">
     <div class="row gutter-xs">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header bg-primary">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
            </div>
            <strong>Inactive Admins</strong>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Region Head</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Tiger</td>
                  <td>John</td>
                  <td>
                    <a class="btn btn-outline-primary btn-xs" title="View Admin" tooltip>
                      <i class="icon icon-eye"></i>
                    </a>
                    <a class="btn btn-outline-success btn-xs" title="Edit Admin" tooltip>
                      <i class="icon icon-edit"></i>
                    </a>
                    <button class="btn btn-outline-danger btn-xs" title="Delete Admin" tooltip>
                      <i class="icon icon-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection