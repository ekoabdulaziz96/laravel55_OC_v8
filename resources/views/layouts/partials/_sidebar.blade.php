  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('adminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          {{-- <p>Alexander Pierce</p> --}}
          {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
         {{--  <p style="font-size: 18px">{{ Auth::user()->nama }}</p>
          <small style="font-style: italic;"> {{ Auth::user()->status }}</small> --}}
        </div>
      </div>
      {{-- profil --}}
{{--       <div align="center" class="input-group-btn">
        <a href="" >
          <button class="btn btn-default">Profile</button>
        </a>
      </div> --}}
      <br>
      <!-- search form -->
{{--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
  
       {{-- @if (Auth::user()->status =='admin'|| Auth::user()->status =='Admin') --}}

          <li class=" " id="adminDashboard">
            <a href="{{ route('admin') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>



{{--           <li class=" " id="adminForm">
            <a href="{{ url('admin/form') }}">
              <i class="fa fa-edit"></i> <span>Form</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li> --}}

{{--           <li class=" " id="adminStatus">
            <a href="{{ url('admin/status') }}">
              <i class="fa fa-user"></i> <span>Kelola Status</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li> --}}

         <li class="treeview" id="adminForm">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Kelola Form</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="ft_admin"><a href="{{ route('admin.form-ft-admin') }}"><i class="fa fa-pencil-square-o"></i>FT-Admin</a></li>
              <li id="ft_sponsorship"><a href="{{ route('admin.form-ft-sponsorship') }}"><i class="fa fa-pencil-square-o"></i>FT-Sponsorship</a></li>
            </ul>
          </li>
          
{{--           <li class="treeview" id="adminForm">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Hak AKses</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li ><a href="{{ url('admin/status') }}"><i class="fa fa-wrench"></i>Kelola Status</a></li>
              <li><a href="{{ url('admin/kategori') }}"><i class="fa fa-wrench"></i>Kelola Kategori</a></li>
            </ul>
          </li> --}}

          <li class=" " id="adminUser">
            <a href="{{ route('admin.user') }}">
              <i class="fa fa-user"></i> <span>Kelola User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>          

          <li class=" " id="adminCabang">
            <a href="{{ route('admin.cabang') }}">
              <i class="fa fa-arrows"></i> <span>Kelola Cabang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>
       {{-- @endif --}}
        <li class="header">MAIN NAVIGATION ft_admin</li>
          <li class=" " id="adminDashboard">
            <a href="{{ route('admin') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          </li>

         <li class="treeview" id="ftAdminLaporan">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Kelola Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="ftAdminLaporan_baru"><a href="{{ route('ft-admin.laporan.baru') }}"><i class="fa fa-pencil-square-o"></i>Laporan Baru</a></li>         
              <li id="ftAdminLaporan_proses"><a href="{{ route('ft-admin.laporan.proses') }}"><i class="fa fa-paper-plane-o"></i>Proses Persetujuan</a></li>      
              <li id="ftAdminLaporan_perbaikan"><a href="{{ route('ft-admin.laporan.perbaikan') }}"><i class="fa fa-wrench"></i>Laporan Perbaikan</a></li>
              <li id="ftAdminLaporan_disetujui"><a href="{{ route('ft-admin.laporan.disetujui') }}"><i class="fa fa-check-square-o"></i>Laporan Disetujui</a></li>

            </ul>
          </li>
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>





