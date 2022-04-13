
 <nav class="main-header navbar navbar-expand navbar-light navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('student.login-home',['student_code'=> Session::get('studentCode')])}}" class="nav-link"><i class="icofont-group-students mr-1"></i>Học sinh</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('student.login-transcript',['student_code'=> Session::get('studentCode'),'id_grade'=>Session::get('idStudentGrade')])}}" class="nav-link"><i class="fa-solid fa-table-list mr-1"></i>Bảng điểm</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{route('logout')}}" class="dropdown-item">
            <i class="fa-solid fa-key"></i> Đổi mật khẩu
          </a>
          <a href="{{route('logout')}}" class="dropdown-item">
            <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>