@extends('layouts.master') @section('title')
<title>Thêm QTV</title>
@endsection @section('content')

@section('css')

@endsection

@section('js')

@endsection

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Thêm QTV</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{route('users.index')}}" class="btn btn-primary float-sm-right">Quay lại</a>
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
            <form action="{{route('users.update',['id'=>$user->id])}}" method="POST" autocomplete="off">
               @csrf
              <div class="row">
                <div class="col">
                  <label for="last_name">Họ:</label>
                  <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                   id="last_name" placeholder="VD: Nguyễn Văn"
                  name="last_name" value="{{old('last_name') ? old('last_name') :$user->last_name}}">
                  @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col">
                  <label for="first_name">Tên:</label>
                  <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                  id="first_name" placeholder="VD: Hoàng"
                  name="first_name" value="{{old('first_name') ? old('first_name') :$user->first_name}}">
                  @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>  
              </div>
              <div class="row">
                <div class="col">
                  <div><label>Giới tính:</label></div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" {{$user->gender == "Nam" ? "Checked" : ""}} type="radio" name="gender" id="Nam" value="Nam">
                    <label class="form-check-label" for="Nam">Nam</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" {{$user->gender == "Nữ" ? "Checked" : ""}} name="gender" id="Nu" value="Nữ">
                    <label class="form-check-label" for="Nu">Nữ</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="date_of_birth">Ngày sinh:</label>
                <input type="date" id="date_of_birth" 
                class="form-control @error('date_of_birth') is-invalid @enderror"
                 name="date_of_birth" value="{{old('date_of_birth') ? old('date_of_birth') :$user->date_of_birth}}">
                @error('date_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
              <div class="row">
                <div class="col">
                  <label for="phone_number">Số điện thoại:</label>
                  <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                   id="phone_number" placeholder="VD: 0981123123132"
                    name="phone_number" value="{{old('phone_number') ? old('phone_number') :$user->phone_number}}">
                   @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col">
                  <label for="address">Địa chỉ:</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" 
                  id="address" placeholder="VD: Hà Nội" 
                  name="address" value="{{old('address') ? old('address') :$user->address}}">
                  @error('address')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>  
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                 name="email" placeholder="VD: nguyenvanhoang@gmail.com" value="{{old('email') ? old('email') : $user->email}}">
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Lưu</button>
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
