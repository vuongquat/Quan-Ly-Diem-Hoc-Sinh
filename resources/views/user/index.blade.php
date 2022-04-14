@extends('layouts.master')
@section('title')
<title>Danh sách quản trị viên</title>
@endsection 

@section('js')
<script src="jquery/sweetalert2.js"></script>
<script src="user/index.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">Danh sách quản trị viên</h1>
                </div>
                <div class="col-sm-4">
                    <form class="form-inline" method="POST" action="">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="" class="mr-1">Tìm kiếm: </label>
                            <input type="text" class="form-control" name="user" placeholder="Tìm kiếm theo tên QTV">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <a
                        href="{{route('users.create')}}"
                        class="btn btn-primary float-sm-right"
                        >Thêm QTV</a
                    >
                </div>
                <!-- /.col -->
            </div>
            @if(session('message'))
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                </div>
            </div>
            @endif
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <table class="table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Email</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$user->last_name .' '.$user->first_name}}</td>
                                        <td>{{$user->gender}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>{{Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y')}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="{{route('users.edit',['id'=>$user->id])}}" class="text-warning mr-5"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="" data-url="{{route('users.delete',['id'=>$user->id])}}" class="text-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-md-center ">
                
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection
