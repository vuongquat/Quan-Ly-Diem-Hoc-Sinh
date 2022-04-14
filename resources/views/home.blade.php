@extends('layouts.master')

@section('title')
<title>Trang chủ</title>
@endsection
@section('css')
<link rel="stylesheet" href="css/home.css">
@endsection
@section('content')

<div class="content-wrapper background-body">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
          <p class="title">Thông tin cá nhân</p>
        </div>
      </div>
      <div class="row justify-content-center text-center mt-5 border-info">
        <div class="col-sm-6 info">
          <div class="name mt-2"><i class="fa-solid fa-address-card mr-1 icon"></i>Họ tên: <span>{{$userLogin->last_name .' '. $userLogin->first_name}}</span></div>
          <div class="date  mt-2"><i class="fa-solid fa-cake-candles mr-1 icon"></i>Ngày sinh: <span>{{Carbon\Carbon::parse($userLogin->date_of_birth)->format('d/m/Y')}}</span></div>
          @if(isset($userLogin->id_class))<div class="class  mt-2"><i class="fa-solid fa-landmark mr-1 icon"></i>Lớp chủ nhiệm: <span>{{$userLogin->class->class_grade}}</span></div>@endif
          <div class="address  mt-2"><i class="fa-solid fa-address-book mr-1 icon"></i>Địa chỉ: <span>{{$userLogin->address}}</span></div>
          <div class="gender  mt-2"><i class="fa-solid fa-mars-and-venus mr-1 icon"></i></i>Giới tính: <span>{{$userLogin->gender}}</span></div>
          <div class="phone  mt-2"><i class="fa-solid fa-phone icon"></i>Điện thoại: <span>{{$userLogin->phone_number}}</span></div>
          <div class="email  mt-2"><i class="fa-solid fa-at icon"></i>Email: <span>{{$userLogin->email}}</span></div>
        </div>
      </div>
    </div>
<!-- /.content -->
</div>
@endsection