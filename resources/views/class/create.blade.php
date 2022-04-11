@extends('layouts.master') @section('title')
<title>Tạo lớp học</title>
@endsection @section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tạo lớp học</h1>
        </div>
        <div class="col-sm-6">
          <a href="javascript:history.back()" class="btn btn-primary float-sm-right">Quay lại</a>
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
            <form action="{{route('classes.store')}}" method="POST" >
               @csrf
              <div class="form-group">
                <label>Tên lớp:</label>
                <input
                  type="text"
                  class="form-control @error('class_grade') is-invalid @enderror"
                  name="class_grade"
                  id="class_grade"
                  placeholder="Nhập tên lớp"
                  value="{{ old('class_grade') }}"
                />
                @error('class_grade')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label>Chọn khối:</label>
                <select 
                  class="form-control @error('id_grade') is-invalid @enderror"
                  name="id_grade"
                  id="id_grade"
                >
                  <option value="">-Chọn khối-</option>
                  @foreach ($grades as $grade)
                    <option 
                    value="{{$grade->id}}" {{old ('id_grade') == $grade->id ? 'selected' : ''}}>{{$grade->grade}}</option>
                  @endforeach
                </select> 
                @error('id_grade')
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
