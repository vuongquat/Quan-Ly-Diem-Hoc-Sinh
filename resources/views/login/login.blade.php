<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập</title>

   <base href="{{asset('')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="iconfont/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="iconfont/iconfont/icofont.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h1 class="title">Hệ thống đăng nhập</h1>
  </div>
  @if(session('message'))
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                {{session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        </div>
    </div>
    @endif
  <!-- /.login-logo -->
  <div class="card p-5">
    <div class="card-body login-card-body">
      <form action="{{route('postlogin')}}" method="post">
        @csrf
          <div class="form-group">
            <label class="user">Tài khoản:</label>
            <div class="input-group form-group mb-3">
              <input type="text" class="form-control @error('user') is-invalid @enderror"
               name="user" placeholder="Tài khoản" value="{{old('user')}}">
              <div class="input-group-append">
                  <div class="input-group-text">
                  <span class="fa-solid fa-user"></span>
                  </div>
              </div>
              @error('user')
                    <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        <div class="form-group">
            <label class="password">Mật khẩu:</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                 name="password" placeholder="Mật khẩu" value="{{old('password')}}">
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </div>
      </form>
  </div>
</div>
<!-- /.login-box -->

<script src="jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
