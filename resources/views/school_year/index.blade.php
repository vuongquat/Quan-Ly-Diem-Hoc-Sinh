@extends('layouts.master')
@section('title')
<title>Năm học</title>
@endsection 

@section('js')
<script src="jquery/sweetalert2.js"></script>
<script src="school_year/index/index.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center mt-5">
                <div class="col-sm-6">
                    <h1 class="">Năm học</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('school-year.create')}}" class="btn btn-primary">Tạo năm học</a>
                </div>
            </div>
            <div class="row justify-content-md-center">
                    @if(session('message'))
                        <div class="col-sm-6">
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                {{session('message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
            </div>
            <div class="row">
                <table class="table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" >#</th>
                            <th scope="col" style="width:70%">Năm học</th>
                            <th scope="col" >Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schoolYears as $schoolYear)
                            <tr>
                                <th scope="row">{{$schoolYear->id}}</th>
                                <td>{{$schoolYear->school_year}}</td>
                                <td>
                                    <a href="" data-url="{{$schoolYear->id}}" class="text-danger action-delete"><i class="fa-solid fa-trash"></i></a>
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
