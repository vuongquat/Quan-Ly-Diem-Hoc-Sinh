@extends('layouts.master') @section('title')
<title>Sửa điểm</title>
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
          <h1 class="m-0">Nhập điểm trung bình các môn học: </h1>
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
            <form action="{{route('student.transcript-update',['id'=>$idStudent,'grade'=>$idGradeStudent,'idTS'=>$transcript->id])}}" method="POST" autocomplete="off">
               @csrf
               <div class="form-row">
                   <div class="form-group col-md-6">
                        <label for="id_semester">Học kỳ:</label>
                        <select name="id_semester" id="id_semester" class="form-control @error('id_semester') is-invalid @enderror">
                            <option value="">-Chọn học kỳ-</option>
                            @foreach($semesters as $semester)
                                <option value="{{$semester->id}}" {{$transcript->id_semester == $semester->id ? 'selected' : ''}}>{{$semester->semester}}</option>
                            @endforeach
                        </select>
                        @error('id_semester')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_school_year">Năm học:</label>
                        <select name="id_school_year" id="id_schoo_year" class="form-control @error('id_school_year') is-invalid @enderror">
                            <option value="">-Chọn năm học-</option>
                            @foreach($schoolYears as $schoolYear)
                                <option value="{{$schoolYear->id}}" {{$transcript->id_school_year == $schoolYear->id ? 'selected' : ''}}>{{$schoolYear->school_year}}</option>
                            @endforeach
                        </select>
                        @error('id_school_year')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
               </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-4">
                        <label for="gpa_math">Toán:</label>
                        <input type="number" class="form-control @error('gpa_math') is-invalid @enderror"
                        value="{{old('gpa_math') ? old('gpa_math') : $transcript->gpa_math}}" id="gpa_math" name="gpa_math" placeholder="8" step="any" >
                        @error('gpa_math')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gpa_literature">Ngữ văn:</label>
                        <input type="number" class="form-control @error('gpa_literature') is-invalid @enderror" 
                        value="{{old('gpa_literature') ? old('gpa_literature') : $transcript->gpa_literature}}" id="gpa_literature" step="any" name="gpa_literature" placeholder="8">
                        @error('gpa_literature')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gpa_english">Tiếng anh:</label>
                        <input type="number" class="form-control @error('gpa_english') is-invalid @enderror" 
                        value="{{old('gpa_english') ? old('gpa_english') : $transcript->gpa_english}}" id="gpa_english" step="any" name="gpa_english" placeholder="8">
                        @error('gpa_english')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-4">
                        <label for="gpa_physics">Vật lý:</label>
                        <input type="number" class="form-control @error('gpa_physics') is-invalid @enderror" 
                        value="{{old('gpa_physics') ? old('gpa_physics') : $transcript->gpa_physics}}"id="gpa_physics" step="any" name="gpa_physics" placeholder="8">
                        @error('gpa_physics')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gpa_chemistry">Hóa học:</label>
                        <input type="number" class="form-control @error('gpa_chemistry') is-invalid @enderror"
                        value="{{old('gpa_chemistry') ? old('gpa_chemistry') : $transcript->gpa_chemistry}}" id="gpa_chemistry" step="any" name="gpa_chemistry" placeholder="8">
                        @error('gpa_chemistry')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gpa_biology">Sinh học:</label>
                        <input type="number" class="form-control @error('gpa_biology') is-invalid @enderror"
                        value="{{old('gpa_biology') ? old('gpa_biology') : $transcript->gpa_biology}}" id="gpa_biology"  step="any" name="gpa_biology" placeholder="8">
                        @error('gpa_biology')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-4">
                        <label for="gpa_history">Lịch sử:</label>
                        <input type="number" class="form-control @error('gpa_history') is-invalid @enderror" 
                        value="{{old('gpa_history') ? old('gpa_history') : $transcript->gpa_history}}"id="gpa_history" step="any" name="gpa_history" placeholder="8">
                        @error('gpa_history')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gpa_geography">Địa lý:</label>
                        <input type="number" class="form-control @error('gpa_geography') is-invalid @enderror" 
                        value="{{old('gpa_geography') ? old('gpa_geography') : $transcript->gpa_geography}}"id="gpa_geography" step="any" name="gpa_geography" placeholder="8">
                        @error('gpa_geography')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gpa_technology">Công nghệ:</label>
                        <input type="number" class="form-control @error('gpa_technology') is-invalid @enderror" 
                        value="{{old('gpa_technology') ? old('gpa_technology') : $transcript->gpa_technology}}"id="gpa_technology" step="any" name="gpa_technology" placeholder="8">
                        @error('gpa_technology')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-3">
                        <label for="gpa_informatics">Tin học:</label>
                        <input type="number" class="form-control @error('gpa_informatics') is-invalid @enderror" 
                        value="{{old('gpa_informatics') ? old('gpa_informatics') : $transcript->gpa_informatics}}"id="gpa_informatics" step="any" name="gpa_informatics" placeholder="8">
                        @error('gpa_informatics')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gpa_civic_education">GDCD:</label>
                        <input type="number" class="form-control @error('gpa_civic_education') is-invalid @enderror" 
                        value="{{old('gpa_civic_education') ? old('gpa_civic_education') : $transcript->gpa_civic_education}}"id="gpa_civic_education" step="any" name="gpa_civic_education" placeholder="8">
                        @error('gpa_civic_education')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gpa_national_defense_education">GDQP:</label>
                        <input type="number" class="form-control @error('gpa_national_defense_education') is-invalid @enderror"
                        value="{{old('gpa_national_defense_education') ? old('gpa_national_defense_education') : $transcript->gpa_national_defense_education}}" step="any" id="gpa_national_defense_education" name="gpa_national_defense_education" placeholder="8">
                        @error('gpa_national_defense_education')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gpa_physical_education">Thể dục:</label>
                        <select name="gpa_physical_education" id="gpa_physical_education" class="form-control @error('gpa_physical_education') is-invalid @enderror">
                            <option value="">-Kết quả-</option>
                            <option value="Đ" {{$transcript->gpa_physical_education == 'Đ' ? 'selected' : ''}}>Đạt</option>
                            <option value="KĐ" {{$transcript->gpa_physical_education == 'KĐ' ? 'selected' : ''}}>Không đạt</option>
                        </select>
                        @error('gpa_national_defense_education')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Sửa</button>
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
