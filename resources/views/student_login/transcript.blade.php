@extends('layouts.student_login')
@section('title')
<title>Bảng điểm</title>
@endsection 

@section('css')
<link rel="stylesheet" href="css/student_login.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <h5 class="m-0">Bảng điểm-{{$studentGrade->grade}} </h5>
                </div>
                <div class="col-sm-2">
                    <p class="text-center mt-1">{{$studentLogin->last_name .' '.$studentLogin->first_name}}</p>
                </div>
                <div class="col-sm-4 text-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Chọn khối
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($grades as $grade)
                                <a class="dropdown-item" href="
                                {{route('student.login-transcript',['student_code'=>$studentLogin->student_code , 'id_grade' => $grade->id])}}" >
                                    {{$grade->grade}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                </div>
                <table class="table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Học kỳ</th>
                            <th scope="col">Năm học</th>
                            <th scope="col">Toán</th>
                            <th scope="col">Ngữ văn</th>
                            <th scope="col">Tiếng anh</th>
                            <th scope="col">Vật lý</th>
                            <th scope="col">Hóa học</th>
                            <th scope="col">Sinh học</th>
                            <th scope="col">Lịch sử</th>
                            <th scope="col">Địa lý</th>
                            <th scope="col">Công nghệ</th>
                            <th scope="col">Tin học</th>
                            <th scope="col">GDCD</th>
                            <th scope="col">GDQP</th>
                            <th scope="col">Thể dục</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($gpaSubjects as $gpaSubject)
                            <tr>
                                <th>{{$gpaSubject->id_semester}}</th>
                                <td>{{$gpaSubject->schoolYear->school_year}}</td>
                                <td>{{$gpaSubject->gpa_math}}</td>
                                <td>{{$gpaSubject->gpa_literature}}</td>
                                <td>{{$gpaSubject->gpa_english}}</td>
                                <td>{{$gpaSubject->gpa_physics}}</td>
                                <td>{{$gpaSubject->gpa_chemistry}}</td>
                                <td>{{$gpaSubject->gpa_biology}}</td>
                                <td>{{$gpaSubject->gpa_history}}</td>
                                <td>{{$gpaSubject->gpa_geography}}</td>
                                <td>{{$gpaSubject->gpa_technology}}</td>
                                <td>{{$gpaSubject->gpa_informatics}}</td>
                                <td>{{$gpaSubject->gpa_civic_education}}</td>
                                <td>{{$gpaSubject->gpa_national_defense_education}}</td>
                                <td>{{$gpaSubject->gpa_physical_education}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12">
                    <h5>Điểm tổng kết cả năm</h5>
                </div>
                <table class="table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Năm học</th>
                            <th scope="col">Điểm TB học kỳ 1</th>
                            <th scope="col">Điểm TB học kỳ 2</th>
                            <th scope="col">Điểm TB cả năm</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($gpaSchoolYear as $gpaSchoolYearDetail)
                            <tr>
                                <td>{{$gpaSchoolYearDetail->schoolYear->school_year}}</td>
                                <td>{{$gpaSchoolYearDetail->gpa_semester_1}}</td>
                                <td>{{$gpaSchoolYearDetail->gpa_semester_2}}</td>
                                <td>{{$gpaSchoolYearDetail->gpa_school_year}}</td>
                            </tr>
                        @endforeach
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
