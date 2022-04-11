<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul
        class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false"
      >
      @can('is-admin')
        <li class="nav-item">
          <a href="{{route('classes.index',['id'=>'all'])}}" class="nav-link">
            <i class="fa-solid fa-school"></i>
            <p>Lớp học</p>
          </a>
        </li>
        @endcan
        @can('is-admin')
        <li class="nav-item">
          <a href="{{route('school-year.index')}}" class="nav-link">
            <i class="fa-solid fa-calendar-days"></i>
            <p>Năm học</p>
          </a>
        </li>
        @endcan
        @can('is-admin')
        <li class="nav-item">
          <a href="{{route('teacher.index')}}" class="nav-link">
            <i class="icofont-teacher"></i>
            <p>Giáo viên</p>
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a href="{{route('student.index',['id'=>'all'])}}" class="nav-link">
            <i class="icofont-group-students"></i>
            <p>Học sinh</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
