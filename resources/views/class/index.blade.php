@extends('layouts.master')
@section('title')
<title>Danh sách lớp học</title>
@endsection 

@section('js')
<script src="jquery/sweetalert2.js"></script>
<script src="class/index/index.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1 class="m-0">Danh sách lớp học</h1>
                </div>
                <div class="col-sm-3 text-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Danh sách theo khối
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('classes.index',['id'=>'all'])}}" >Tất cả lớp học</a>
                            @foreach($grades as $grade)
                                <a class="dropdown-item" href="{{route('classes.index',['id'=>$grade->id])}}" >{{$grade->grade}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                     <form class="form-inline" method="POST" action="{{route('classes.search')}}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="" class="mr-1">Tìm kiếm: </label>
                            <input type="text" class="form-control" name="class" placeholder="Tìm kiếm theo tên lớp">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                
                <div class="col-sm-2">
                    <a
                        href="{{route('classes.create')}}"
                        class="btn btn-primary float-sm-right"
                        >Tạo lớp học</a
                    >
                </div>
                <!-- /.col -->
            </div>
            @if(session('message_success'))
            <div class="row justify-content-md-center">
                <div class="col-sm-6">
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{session('message_success')}}
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
                            <th scope="col" style="width:40%">Lớp</th>
                            <th scope="col" style="width:40%">Khối</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($classGrades))
                            @if(count($classGrades) > 0)
                                @foreach ($classGrades as $class)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$class->class_grade}}</td>
                                        <td>{{$class->grade->grade}}</td>
                                        <td>
                                            <a href="{{route('classes.edit', ['id'=> $class->id])}}" class="text-warning mr-5"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="" data-url="{{$class->id}}" class="text-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th></th>
                                    <td col="4">Không tìm thấy kết quả nào</td>
                                </tr>
                            @endif    
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-md-center ">
                    {{ $classGrades->links('pagination::bootstrap-4')}}
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection
