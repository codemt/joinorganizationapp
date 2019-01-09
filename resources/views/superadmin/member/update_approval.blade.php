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
                    <a href="#" class="btn btn-outline-success btn-xs pull-right" id="approve_all" tooltip>
                        Approve Selected
                    </a>
                    <table class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <label class="custom-control custom-control-primary custom-checkbox">
                                        <input class="custom-control-input" id="checkAll" type="checkbox" name="" value="">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-label">#</span>
                                    </label>
                                </th>
                                <th>Member Name</th>
                                <th>Member Code</th>
                                <th>Type of Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            $count = 0;
                            @endphp
                            <?php foreach ($output as $output)  {?>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-control-primary custom-checkbox">
                                            <input class="custom-control-input check-row" type="checkbox" name="" value="">
                                            <p class="member_id" style="display:none;">{{$output->member_id}}</p>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-label">{{ ++$count }}</span>
                                        </label>
                                    </td>
                                    <td>{{ $output->f_name }} {{ $output->l_name }}</td>
                                    <td>{{ $output->member_type }} {{ $output->member_code }}</td>
                                    <td class="type">Family Update</td>
                                    <td>
                                        <a href="get_family_info_member/{{ $output->member_id }}" target="_blank" class="btn btn-outline-success btn-xs" title="View Changes" tooltip>
                                            <i class="icon icon-eye"></i>
                                        </a>
                                        @if (Auth::user()["role"] == 0)
                                            <a href="approve_family_super_admin/{{ $output->member_id }}" class="btn btn-outline-success btn-xs" title="Approve Changes" tooltip>
                                                <i class="icon icon-check"></i>
                                            </a>
                                        @else
                                            <a href="approve_family_region_admin/{{ $output->member_id }}" class="btn btn-outline-success btn-xs" title="Approve Changes" tooltip>
                                                <i class="icon icon-check"></i>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                                <?php }?>
                                @php
                                $i = 1;
                                @endphp
                                <?php foreach ($output1 as $output1)  {?>
                                    <tr>
                                        <td>
                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                <input class="custom-control-input check-row" type="checkbox" name="" value="">
                                                <p class="member_id" style="display:none;">{{$output1->member_id}}</p>
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-label">{{ ++$count }}</span>
                                            </label>
                                        </td>
                                        <td>{{ $output1->f_name }} {{ $output1->l_name }}</td>
                                        <td>{{ $output1->member_type }} {{ $output1->member_code }}</td>
                                        <td class="type">Profile Update</td>
                                        <td>
                                            <a href="user_profile_view/{{ $output1->member_id }}" target="_blank" class="btn btn-outline-success btn-xs" title="View Changes" tooltip>
                                                <i class="icon icon-eye"></i>
                                            </a>
                                            @if (Auth::user()["role"] == 0)
                                                <a href="approve_update_super_admin/{{ $output1->member_id }}" class="btn btn-outline-success btn-xs" title="Approve Changes" tooltip>
                                                    <i class="icon icon-check"></i>
                                                </a>
                                            @else
                                                <a href="approve_update_region_admin/{{ $output1->member_id }}" class="btn btn-outline-success btn-xs" title="Approve Changes" tooltip>
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

        @push('page-script')
            <script>
            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $("#approve_all").click(function () {

                var member_id = [];

                var update_type = [];

                $('input[type=checkbox]:checked').not("#checkAll").each(function () {

                    member_id.push($(this).parent().find(".member_id").text());
                    update_type.push($(this).parent().parent().parent().find(".type").text());

                });

                @if (Auth::user()["role"] == 0)
                    $.ajax({
                          url: "{{ route('approve_member_superadmin_bulk') }}",
                          method: "POST",
                          data: {
                           'member_id' : member_id ,
                           'update_type' : update_type
                            },
                          cache: false,
                          success: function(html){
                             alert("Approved Successfully");

                                  location.reload();

                             return;
                          }
                        });
                @else
                    $.ajax({
                              url: "{{ route('approve_member_regional_bulk') }}",
                              method: "POST",
                              data: {
                               'member_id' : member_id ,
                               'update_type' : update_type
                                },
                              cache: false,
                              success: function(html){
                                 alert("Approved Successfully");

                                      location.reload();

                                 return;
                              }
                          });
                @endif

            });

            </script>
        @endpush
