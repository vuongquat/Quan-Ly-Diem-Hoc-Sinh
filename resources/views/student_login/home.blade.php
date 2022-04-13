@extends('layouts.student_login')
@section('title')
<title>Trang chủ</title>
@endsection 

@section('css')
<link rel="stylesheet" href="css/student_login.css">
@endsection
@section('content')
<div class="content-wrapper background-body">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
          <p class="title">Thông tin học sinh</p>
        </div>
      </div>
      <div class="row justify-content-center text-center mt-5 border-info">
        <div class="col-sm-6 info">
          <div class="name mt-2"><i class="fa-solid fa-address-card mr-1"></i>Họ tên: <span>{{$studentLogin->last_name.' '.$studentLogin->first_name}}</span></div>
          <div class="date  mt-2"><i class="fa-solid fa-cake-candles mr-1"></i>Ngày sinh: <span>{{Carbon\Carbon::parse($studentLogin->date_of_birth)->format('d/m/Y')}}</span></div>
          <div class="class  mt-2"><i class="fa-solid fa-landmark mr-1"></i>Lớp: <span>{{$studentLogin->class->class_grade}}</span></div>
          <div class="address  mt-2"><i class="fa-solid fa-address-book mr-1"></i>Địa chỉ: <span>{{$studentLogin->address}}</span></div>
          <div class="gender  mt-2"><i class="fa-solid fa-mars-and-venus mr-1"></i></i>Giới tính: <span>{{$studentLogin->gender}}</span></div>
        </div>
      </div>
    </div>
<!-- /.content -->
</div>
@endsection
