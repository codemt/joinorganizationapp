<div class="custom-scrollbar">
    <nav id="sidenav" class="sidenav-collapse collapse">
        <ul class="sidenav">
            @if (Auth::user()["role"] == 0)
            <li class="sidenav-heading">Navigation</li>
            <li class="sidenav-item {{ Request::path() == '/' ? 'active' : '' }}">
                <a href="/">
                    <span class="sidenav-icon icon icon-home"></span>
                    <span class="sidenav-label">Dashboard</span>
                </a>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-user"></span>
                    <span class="sidenav-label">Member</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('member.create') }}">Add Member</a>
                    </li>
                    <li class="">
                        <a href="{{ route('member.index') }}">All Member</a>
                    </li>
                    <li class="">
                        <a href="{{ route('get_family_superadmin') }}">Approve Updates</a>
                    </li>
                    <li class="">
                        <a href="{{ route('get_new_registration_super_admin') }}">Approve New Registrations</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-th-large"></span>
                    <span class="sidenav-label">Regions</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('region.create') }}">Add Region</a>
                    </li>
                    <li class="">
                        <a href="{{ route('region.index') }}">All Region</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-users"></span>
                    <span class="sidenav-label">Samiti</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('samiti.create') }}">Add Samiti</a>
                    </li>
                    <li class="">
                        <a href="{{ route('samiti.index') }}">All Samiti</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-calendar-check-o"></span>
                    <span class="sidenav-label">Events</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('add_event') }}">Add Events</a>
                    </li>
                    <li class="">
                        <a href="{{ route('get_event') }}">All Events</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-map-marker"></span>
                    <span class="sidenav-label">Venue</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('add_venue') }}">Add Venue</a>
                    </li>
                    <li class="">
                        <a href="{{ route('get_venue') }}">All Venue</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-user-times"></span>
                    <span class="sidenav-label">Obituary</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('obituary.create') }}">Add Obituary</a>
                    </li>
                    <li class="">
                        <a href="{{ route('obituary.index') }}">All Obituary</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">
                <a href="javascript:;" aria-haspopup="true">

                    <span class="sidenav-icon icon icon-file-pdf-o"></span>
                    <span class="sidenav-label">Brochure</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('brochure.create') }}">Add Brochure</a>
                    </li>
                    <li class="">
                        <a href="{{ route('brochure.index') }}">All Brochure</a>
                    </li>
                </ul>
            </li>
            <li class="sidenav-item has-subnav">

                <a href="javascript:;" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-image"></span>
                    <span class="sidenav-label">Gallery</span>
                </a>
                <ul class="sidenav-subnav collapse">
                    <li class="">
                        <a href="{{ route('gallery.create') }}">Add Gallery</a>
                    </li>
                    <li class="">
                        <a href="{{ route('gallery.index') }}">All Gallery</a>
                    </li>
                </ul>
            </li>
            @endif
            @if (Auth::user()["role"] == 1)


            <?php $type = getMemberType(); ?>
            <li class="sidenav-heading">Member Dashboard</li>

                @if (in_array('RA',$type))
                   <li class="sidenav-item">
                       <a href="{{ route('get_regions_admin') }}">
                           <span class="sidenav-icon icon icon-calendar-check-o"></span>
                           <span class="sidenav-label">Assigned Regions </span>
                       </a>
                   </li>

                   <li class="sidenav-item">
                        <a href="{{ route('get_family_region') }}">
                            <span class="sidenav-icon icon icon-calendar-check-o"></span>
                            <span class="sidenav-label">Approve Updates</span>
                        </a>
                   </li>

                   <li class="">
                       <a href="{{ route('get_new_registration_regional') }}">
                           <span class="sidenav-icon icon icon-calendar-check-o"></span>
                           <span class="sidenav-label">Approve New Registrations</span>
                       </a>
                   </li>

                @if (!in_array('SA',$type))
                      <li class="sidenav-item">
                          <a href="{{ route('samiti.index') }}">
                              <span class="sidenav-icon icon icon-calendar-check-o"></span>
                              <span class="sidenav-label">Samitis in Assigned Region </span>
                          </a>
                      </li>
                   @endif
                @endif

                @if (in_array('SA',$type))
                    <li class="sidenav-item">
                        <a href="{{ route('samiti.index') }}">
                            <span class="sidenav-icon icon icon-calendar-check-o"></span>
                            <span class="sidenav-label">Assigned Samitis </span>
                        </a>
                    </li>
                @endif

                @if (in_array('SM',$type) && !in_array('SA',$type) && !in_array('RA',$type))
                    <li class="sidenav-item">
                        <a href="{{ route('samiti.index') }}">
                            <span class="sidenav-icon icon icon-calendar-check-o"></span>
                            <span class="sidenav-label">Associated Samitis </span>
                        </a>
                    </li>
                @endif


            {{-- <li class="sidenav-item">

                <a href="{{ route('View_Events') }}">
                    <span class="sidenav-icon icon icon-calendar-check-o"></span>
                    <span class="sidenav-label">Events</span>
                </a>
            </li> --}}

            <li class="sidenav-item">
                <a href="{{ route('User_Profile') }}">
                    <span class="sidenav-icon icon icon-user"></span>
                    <span class="sidenav-label">Profile</span>
                </a>
            </li>

            <li class="sidenav-item">

              <a href="{{ route('About_Family') }}">
                  <span class="sidenav-icon icon icon-users"></span>
                  <span class="sidenav-label">About Family</span>
              </a>
          </li>
            @endif
        </ul>
    </nav>
</div>
