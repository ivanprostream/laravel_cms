<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages: style can be found in dropdown.less-->
 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <a href="{{ url('admin/mailbox/Inbox') }}" class="dropdown-item dropdown-footer">Смотреть все</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" href="{{ url('/admin/settings') }}">
          <i class="far fa-user-circle"></i> Настройки
        </a>
      </li>

      <li class="nav-item dropdown">

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Выход
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

