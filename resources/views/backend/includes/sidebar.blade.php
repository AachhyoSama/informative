 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ Storage::disk('uploads')->url($setting->company_favicon) }}" alt="{{ $setting->company_name['en'] }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $setting->company_name['en'] }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex"> --}}
        {{-- <div class="image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div> --}}

      {{-- </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <a href="{{ env('APP_URL') }}" target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-globe"></i>
                    <p>
                        Website
                    </p>
                </a>
            </div>
        </li>

          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('users.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('message.index') }}" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Customer Mail
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('subscribers.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Subscribers
              </p>
            </a>
          </li>

            <li class="nav-item">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <a href="#" class="nav-link">
                        <p>
                            All CMS
                        </p>
                    </a>
                </div>
            </li>

        <li class="nav-item">
            <a href="{{ route('slider.index') }}" class="nav-link">
              <i class="fas fa-film nav-icon"></i>
              <p>Sliders</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('popupnotice.index') }}" class="nav-link">
              <i class="fas fa-list nav-icon"></i>
              <p>Pop up Notices</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Members
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px;">
                        <li class="nav-item">
                            <a href="{{ route('memberCategory.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Member Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('commiteeCategory') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Commities Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                <a href="{{ route('member.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Members</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('member.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Member</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                News
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('news.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View News</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('news.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create News</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('blogs.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Blogs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('blogs.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Blogs</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Album
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('album.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Albums</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('album.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Album</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Menu Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('menu.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Menu List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('menu.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Menu</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('partner.index') }}" class="nav-link">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Partners
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('download.index') }}" class="nav-link">
              <i class="nav-icon fas fa-arrow-down"></i>
              <p>
                Downloads
              </p>
            </a>
          </li>

          <li class="nav-item">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <a href="#" class="nav-link">
                    <p>
                        Settings
                    </p>
                </a>
            </div>
        </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('setting.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Company Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('socialMedia') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Social Media</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('aboutUs') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('missionVision') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mission and Vision</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('bullets.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Features in Bullets</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('benefits.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Membership Benefits</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('advertisements.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advertisement settings</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
