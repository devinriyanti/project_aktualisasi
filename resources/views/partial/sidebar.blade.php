<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('/template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Kanwil Kemenkum Kalsel</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Halaman
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/rekening" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Agenda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/target" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Buku Tamu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/pajak" target="_blank" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Cetak Laporan 
              </p>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>