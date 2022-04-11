@extends('layouts.master')
@section('title')
<title>Danh sách giáo viên</title>
@endsection 

@section('js')
<script src="jquery/sweetalert2.js"></script>
<script src="teachers/index/index.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">Danh sách giáo viên</h1>
                </div>
                <div class="col-sm-4">
                    <form class="form-inline" method="POST" action="{{route('teacher.search')}}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="" class="mr-1">Tìm kiếm: </label>
                            <input type="text" class="form-control" name="teacher" placeholder="Tìm kiếm theo tên giáo viên">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <a
                        href="{{route('teacher.create')}}"
                        class="btn btn-primary float-sm-right"
                        >Thêm giáo viên</a
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
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Lớp</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Email</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($teachers))
                            @if(count($teachers) > 0)
                                @foreach($teachers as $teacher)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$teacher->last_name .' '.$teacher->first_name}}</td>
                                        <td>{{$teacher->gender}}</td>
                                        <td>{{$teacher->class->class_grade}}</td>
                                        <td>{{$teacher->phone_number}}</td>
                                        <td>{{Carbon\Carbon::parse($teacher->date_of_birth)->format('d/m/Y')}}</td>
                                        <td>{{$teacher->address}}</td>
                                        <td>{{$teacher->email}}</td>
                                        <td>
                                            <a href="{{route('teacher.edit',['id'=>$teacher->id])}}" class="text-warning mr-5"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="" data-url="{{$teacher->id}}" class="text-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th></th>
                                    <td>Không tìm thấy kết quả</td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <th></th>
                                <td>Không tìm thấy kết quả</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-md-center ">
                {{ $teachers->links('pagination::bootstrap-4') }}
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection
