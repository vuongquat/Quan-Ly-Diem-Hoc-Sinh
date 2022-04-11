@extends('layouts.master') @section('title')
<title>Tạo lớp học</title>
@endsection @section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tạo năm học</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{route('school-year.index')}}" class="btn btn-primary float-sm-right">Quay lại</a>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <div class="col-md-6">
            <form action="{{route('school-year.store')}}" method="POST" >
               @csrf
              <div class="form-group">
                <label>Năm học:</label>
                <div class="text-warning ml-2">Nhập năm bắt đầu kì học VD: 2021</div>
                <div class="form-inline justify-content-md-center">
                    <input
                  type="number"
                  class="form-control @error('start_year') is-invalid @enderror"
                  name="start_year"
                  id="start_year"
                  placeholder="Năm bắt đầu"
                  value="{{old('start_year')}}"
                />
                </div>
                @error('start_year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Tạo</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>


@endsection
