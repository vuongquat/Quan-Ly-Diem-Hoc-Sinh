@extends('layouts.master')
@section('title')
<title>Danh sách học sinh</title>
@endsection 

@section('js')
<script src="jquery/sweetalert2.js"></script>
<script src="students/index/index.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">Kết quả tìm kiếm</h1>
                </div>
                <div class="col-sm-2 text-center">
                    @can('is-admin')
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Chọn lớp
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('student.index',['id'=>'all'])}}" >Tất cả học sinh</a>
                            @foreach($classGrades as $classGrade)
                                <a class="dropdown-item" href="{{route('student.index',['id'=>$classGrade->id])}}" >{{$classGrade->class_grade}}</a>
                            @endforeach
                        </div>
                    </div>
                    @endcan
                </div>
                <div class="col-sm-4">
                    <form class="form-inline" method="POST" action="{{route('student.search')}}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="" class="mr-1">Tìm kiếm: </label>
                            <input type="text" class="form-control" name="student" placeholder="Tìm theo tên hoặc MHS">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <!-- /.col -->
                <div class="col-sm-2">
                    <a
                        href="{{route('student.create')}}"
                        class="btn btn-primary float-sm-right"
                        >Thêm học sinh</a
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
                            <th scope="col">Mã học sinh</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Lớp</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($students))
                            @if(count($students)>0)
                                @foreach($students as $student)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1 }}</th>
                                        <td>{{$student->last_name.' '.$student->first_name}}</td>
                                        <td>{{$student->student_code}}</td>
                                        <td>{{$student->gender}}</td>
                                        <td>{{$student->class->class_grade}}</td>
                                        <td>{{Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y')}}</td>
                                        <td>{{$student->address}}</td>
                                        <td>
                                            <a href="{{route('student.transcript',['id'=>$student->id,'grade'=>$student->class->id_grade])}}" title="Bảng điểm" class="text-primary mr-3"><i class="fa-solid fa-table-list"></i></a>
                                            <a href="{{route('student.edit',['id'=>$student->id])}}" class="text-warning mr-3"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="" data-url="{{$student->id}}" class="text-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th></th>
                                    <td>Không tìm thấy kết quả nào phù hợp</td>
                                </tr>
                            @endif
                        @else
                                <tr>
                                    <th></th>
                                    <td>Không tìm thấy kết quả nào phù hợp</td>
                                </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection
