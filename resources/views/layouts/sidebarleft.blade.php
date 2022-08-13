<style>
.active {
  color: green;
}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BPSPAM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="/dashboard/index" class="nav-link {{ (request()->is('dashboard/index')) ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-tachometer-alt" title="Dashboard"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left" title="Data Master"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/datamasterpelanggan/index" class="nav-link {{ (request()->is('datamasterpelanggan/index')) ? 'active' : ' ' }}">
                  <i class="fas fa-id-card nav-icon" title="Data Master Pelanggan"></i>
                  <p>Data Master Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/datamasterharga/index" class="nav-link {{ (request()->is('datamasterharga/index')) ? 'active' : ' ' }}">
                  <i class="fas fa-money-bill nav-icon" title="Data Master Harga"></i>
                  <p>Data Master Harga</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/datamasterclass/index" class="nav-link {{ (request()->is('datamasterclass/index')) ? 'active' : ' ' }}">
                  <i class="fas fa-sort-numeric-down nav-icon" title="Data Master Class"></i>
                  <p>Data Master Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/datamasteruser/index" class="nav-link {{ (request()->is('datamasteruser/index')) ? 'active' : ' ' }}">
                  <i class="fas fa-user-alt nav-icon" title="Data Master User"></i>
                  <p>Data Master User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/datamasteruserlevel/index" class="nav-link {{ (request()->is('datamasteruserlevel/index')) ? 'active' : ' ' }}">
                  <i class="fas fa-sort-alpha-down nav-icon" title="Data Master User Level"></i>
                  <p>Data Master User Level</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/datatransaksi/index" class="nav-link {{ (request()->is('datatransaksi/index')) ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-file-alt" title="Data Transaksi"></i>
              <p>
                Data Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/report/index" class="nav-link {{ (request()->is('report/index')) ? 'active' : ' ' }}">
              <i class="nav-icon fas fa-money-check-alt" title="Report"></i>
              <p>
                Report
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="fas fa-user-tie"></i>
              <p>
                Account
                <i class="nav-icon right fas fa-angle-left" title="Account"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              {{-- <li class="nav-item">
                <a href="/autentikasi/ubahpassword" class="nav-link">
                  <i class="fas fa-lock nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a href="/logout" class="nav-link">
                  <i class="fas fa-sign-out-alt nav-icon" title="Logout"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
          
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
  {{-- document.querySelectorAll(".nav-item").forEach((ele) =>
  ele.addEventListener("click", function (event) {
    event.preventDefault();
    document
      .querySelectorAll(".nav-item")
      .forEach((ele) => ele.classList.remove("active"));
    this.classList.add("active")
  })
); --}}
  </script>