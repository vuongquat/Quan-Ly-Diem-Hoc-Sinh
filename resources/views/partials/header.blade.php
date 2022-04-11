
 <nav class="main-header navbar navbar-expand navbar-light navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link"></i>Home</a>
      </li>
      @can('is-admin')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('classes.index',['id'=>'all'])}}" class="nav-link"><i class="fa-solid fa-school mr-1"></i>Lớp học</a>
      </li>
      @endcan
      @can('is-admin')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('school-year.index')}}" class="nav-link"><i class="fa-solid fa-calendar-days mr-1"></i>Năm học</a>
      </li>
      @endcan
      @can('is-admin')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('teacher.index')}}" class="nav-link"><i class="icofont-teacher mr-1"></i>Giáo viên</a>
      </li>
      @endcan
      <li class="nav-item d-none d-sm-inline-block">
        <a @can('is-admin') 
        href="{{route('student.index',['id'=>'all'])}}" 
        @else
        href="{{route('student.index',['id'=>Session::get('idClassTeacher')])}}" 
        @endcan
        class="nav-link"><i class="icofont-group-students mr-1"></i>Học sinh</a>
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
          <div class="dropdown-divider"></div>
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