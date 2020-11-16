<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link">
      <img src="{{ asset('public/theme/dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'CRM') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/theme/dist/img/avatar04.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('/admin/settings') }}" class="d-block">{{ \Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ url('/admin/structure') }}" class="nav-link {{ Request::segment(2) == "structure"?"active":"" }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Стуктура сайта
                {{-- <span class="badge badge-info right">2</span> --}}
              </p>
            </a>
          </li>

          @foreach(getParentPages() as $page)

            <li class="nav-item">
                <a href="{{ route('pages.show', $page->id) }}" class="nav-link {{ Request::segment(3) == $page->id?"active":"" }}">
                    <i class="nav-icon fas fa-book"></i> <p>{{ $page->name }}</p>
                </a>
            </li>
          @endforeach




      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>