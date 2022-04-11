<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Semester;
use App\Models\SchoolYear;
use App\Models\GPASubject;
use App\Models\GPASchoolYear;
use App\Http\Requests\transcript\TranscriptAddRequest;
use App\Http\Requests\transcript\TranscriptEditRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class TranscriptController extends Controller
{
    private $grade;
    private $student;
    private $semester;
    private $schoolYear;
    private $gpaSubject;
    private $gpaSchoolYear;

    public function __construct(Grade $grade, Student $student, SchoolYear $schoolYear, Semester $semester, GPASubject $gpaSubject, GPASchoolYear $gpaSchoolYear){
        $this->grade = $grade;
        $this->student = $student;
        $this->semester = $semester;
        $this->schoolYear = $schoolYear;
        $this->gpaSubject = $gpaSubject;
        $this->gpaSchoolYear = $gpaSchoolYear;
    }

    public function GPASubject($request){
        $gpa_math = $request->gpa_math;
        $gpa_literature = $request->gpa_literature;
        $gpa_english = $request->gpa_english;
        $gpa_physics = $request->gpa_physics;
        $gpa_chemistry = $request->gpa_chemistry;
        $gpa_biology = $request->gpa_biology;
        $gpa_history = $request->gpa_history;
        $gpa_geography = $request->gpa_geography;
        $gpa_technology = $request->gpa_technology;
        $gpa_informatics = $request->gpa_informatics;
        $gpa_civic_education = $request->gpa_civic_education;
        $gpa_national_defense_education = $request->gpa_national_defense_education;
        $gpa_subject = ($gpa_math + $gpa_literature + $gpa_english 
        + $gpa_physics + $gpa_chemistry + $gpa_biology +$gpa_history 
        + $gpa_geography + $gpa_technology + $gpa_informatics +$gpa_civic_education + $gpa_national_defense_education)/12;
        $gpa_subject = round($gpa_subject,1);
        return $gpa_subject;
    }

    public function index($id, $grade){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        if(isset($idUserTeacher) && isset($idClassTeacher)){
            $student = $this->student->where('id',$id)->where('id_class',$idClassTeacher)->first();
            $grades = $this->grade->whereNotIn('grade',['Đã tốt nghiệp'])->get();
            $gradeChoose = $grade;
            $studentGrade = $this->grade->find($gradeChoose);
            $gpaSubjects = $this->gpaSubject->where('id_student',$id)->where('id_grade',$grade)->get();
            $gpaSchoolYear = $this->gpaSchoolYear->where('id_student',$id)->where('id_grade',$grade)->get();
            if(isset($student) && isset($grades) && isset($studentGrade)){
                return view('transcript.index',compact('grades','student','gradeChoose','studentGrade','gpaSubjects','gpaSchoolYear'));
            }else
            {
                return abort(403,'Không tìm thấy!');
            }
            
        }

        if(Gate::allows('is-admin')){
            $student = $this->student->find($id);
            $grades = $this->grade->whereNotIn('grade',['Đã tốt nghiệp'])->get();
            $gradeChoose = $grade;
            $studentGrade = $this->grade->find($gradeChoose);
            $gpaSubjects = $this->gpaSubject->where('id_student',$id)->where('id_grade',$grade)->get();
            $gpaSchoolYear = $this->gpaSchoolYear->where('id_student',$id)->where('id_grade',$grade)->get();
            return view('transcript.index',compact('grades','student','gradeChoose','studentGrade','gpaSubjects','gpaSchoolYear'));
        }else{
            return view('home');
        }
        
    }

    public function create($id, $grade){
        $idUserTeacher = Session::get('idUserTeacher');
        $idClassTeacher = Session::get('idClassTeacher');
        if(isset($idUserTeacher) && isset($idClassTeacher)){
            $idStudent = $id;
            $idGradeStudent = $grade;
            $semesters = $this->semester->all();
            $schoolYears = $this->schoolYear->orderBy('school_year')->get();
            return view('transcript.create',compact('semesters','schoolYears','idStudent','idGradeStudent'));
        }
        if(Gate::allows('is-admin')){
            $idStudent = $id;
            $idGradeStudent = $grade;
            $semesters = $this->semester->all();
            $schoolYears = $this->schoolYear->orderBy('school_year')->get();
            return view('transcript.create',compact('semesters','schoolYears','idStudent','idGradeStudent'));
        }else{
            return view('home');
        }
    }

    public function store(TranscriptAddRequest $request, $id, $grade){
        $idStudent = $id;
        $idGradeStudent = $grade;
        try{
            $gpa_subject = $this->GPASubject($request);
            //check semester and schoolyear
            $checkSemesterSchoolYear = $this->gpaSubject->where('id_student',$idStudent)->where('id_school_year',$request->id_school_year)->where('id_semester',$request->id_semester)->first();
            if($checkSemesterSchoolYear === null){
                $this->gpaSubject->create([
                    'id_student' => $idStudent,
                    'id_school_year'=>$request->id_school_year,
                    'id_semester'=>$request->id_semester,
                    'id_grade'=>$idGradeStudent,
                    'gpa_math' => $request->gpa_math,
                    'gpa_literature' => $request->gpa_literature,
                    'gpa_english' => $request->gpa_english,
                    'gpa_physics' => $request->gpa_physics,
                    'gpa_chemistry' => $request->gpa_chemistry,
                    'gpa_biology' => $request->gpa_biology,
                    'gpa_history' => $request->gpa_history,
                    'gpa_geography' => $request->gpa_geography,
                    'gpa_technology' => $request->gpa_technology,
                    'gpa_informatics' => $request->gpa_informatics,
                    'gpa_civic_education' => $request->gpa_civic_education,
                    'gpa_national_defense_education'=> $request->gpa_national_defense_education,
                    'gpa_physical_education' => $request->gpa_physical_education
                ]);
                //check gpaschoolyear
                $checkGPASchoolYear = $this->gpaSchoolYear->where('id_student',$idStudent)->where('id_school_year',$request->id_school_year)->first();
                if($checkGPASchoolYear == null){
                    if($request->id_semester == 1){
                        $data = $this->gpaSchoolYear->create([
                            'id_student' => $idStudent,
                            'id_school_year' => $request->id_school_year,
                            'id_grade' => $idGradeStudent,
                            'gpa_semester_1' => $gpa_subject
                        ]);
                    }
                    else if($request->id_semester == 2){
                        $this->gpaSchoolYear->create([
                            'id_student' => $idStudent,
                            'id_school_year' => $request->id_school_year,
                            'id_grade' => $idGradeStudent,
                            'gpa_semester_2' => $gpa_subject
                        ]);
                    }
                }
                else{
                    if($request->id_semester == 1){
                        $gpa_semester_2 = $checkGPASchoolYear->gpa_semester_2;
                        $gpa_school_year = round(($gpa_subject + $gpa_semester_2*2)/3,1);
                        $this->gpaSchoolYear->find($checkGPASchoolYear->id)->update([
                            'gpa_semester_1' => $gpa_subject,
                            'gpa_school_year' => $gpa_school_year,
                        ]);
                    }
                    else if($request->id_semester == 2){
                        $gpa_semester_1 = $checkGPASchoolYear->gpa_semester_1;
                        $gpa_school_year = round(($gpa_semester_1 + $gpa_subject*2)/3,1);
                        $this->gpaSchoolYear->find($checkGPASchoolYear->id)->update([
                            'gpa_semester_2' => $gpa_subject,
                            'gpa_school_year' => $gpa_school_year,
                        ]);
                    }
                }
            return redirect()->route('student.transcript',['id'=>$idStudent,'grade'=>$idGradeStudent])->with('message','Nhập điểm thành công!');
            }
            else{
                return redirect()->route('student.transcript',['id'=>$idStudent,'grade'=>$idGradeStudent])->with('message','Bảng điểm năm học này đã tồn tại. Vui lòng kiểm tra lại!');
            }
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('student.transcript',['id'=>$idStudent,'grade'=>$idGradeStudent])->with('message','Lỗi'.$e->getMessage());
        }
    }

    public function edit($id, $grade, $idTS){
        $idStudent = $id;
        $idGradeStudent = $grade;
        $semesters = $this->semester->all();
        $schoolYears = $this->schoolYear->orderBy('school_year')->get();
        $transcript = $this->gpaSubject->find($idTS);
        return view('transcript.edit',compact('idStudent','idGradeStudent','semesters','schoolYears','transcript'));
    }

    public function update(TranscriptEditRequest $request , $id, $grade, $idTS){
        $idStudent = $id;
        $idGradeStudent = $grade;
        try{
            $gpa_subject = $this->GPASubject($request);
            $this->gpaSubject->find($idTS)->update([
                'id_student' => $idStudent,
                'id_school_year'=>$request->id_school_year,
                'id_semester'=>$request->id_semester,
                'id_grade'=>$idGradeStudent,
                'gpa_math' => $request->gpa_math,
                'gpa_literature' => $request->gpa_literature,
                'gpa_english' => $request->gpa_english,
                'gpa_physics' => $request->gpa_physics,
                'gpa_chemistry' => $request->gpa_chemistry,
                'gpa_biology' => $request->gpa_biology,
                'gpa_history' => $request->gpa_history,
                'gpa_geography' => $request->gpa_geography,
                'gpa_technology' => $request->gpa_technology,
                'gpa_informatics' => $request->gpa_informatics,
                'gpa_civic_education' => $request->gpa_civic_education,
                'gpa_national_defense_education'=> $request->gpa_national_defense_education,
                'gpa_physical_education' => $request->gpa_physical_education
            ]);
            //check gpaschoolyear
            $checkGPASchoolYear = $this->gpaSchoolYear->where('id_student',$idStudent)->where('id_school_year',$request->id_school_year)->first();
            if($checkGPASchoolYear == null){
                if($request->id_semester == 1){
                    $data = $this->gpaSchoolYear->create([
                        'id_student' => $idStudent,
                        'id_school_year' => $request->id_school_year,
                        'id_grade' => $idGradeStudent,
                        'gpa_semester_1' => $gpa_subject
                    ]);
                }
                else if($request->id_semester == 2){
                    $this->gpaSchoolYear->create([
                        'id_student' => $idStudent,
                        'id_school_year' => $request->id_school_year,
                        'id_grade' => $idGradeStudent,
                        'gpa_semester_2' => $gpa_subject
                    ]);
                }
            }
            else{
                if($request->id_semester == 1){
                    $gpa_semester_2 = $checkGPASchoolYear->gpa_semester_2;
                    $gpa_school_year = round(($gpa_subject + $gpa_semester_2*2)/3,1);
                    $this->gpaSchoolYear->find($checkGPASchoolYear->id)->update([
                        'gpa_semester_1' => $gpa_subject,
                        'gpa_school_year' => $gpa_school_year,
                    ]);
                }
                else if($request->id_semester == 2){
                    $gpa_semester_1 = $checkGPASchoolYear->gpa_semester_1;
                    $gpa_school_year = round(($gpa_semester_1 + $gpa_subject*2)/3,1);
                    $this->gpaSchoolYear->find($checkGPASchoolYear->id)->update([
                        'gpa_semester_2' => $gpa_subject,
                        'gpa_school_year' => $gpa_school_year,
                    ]);
                }
            }
            return redirect()->route('student.transcript',['id'=>$idStudent,'grade'=>$idGradeStudent])->with('message','Sửa điểm thành công!');
        }
        catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
            return redirect()->route('student.transcript',['id'=>$idStudent,'grade'=>$idGradeStudent])->with('message','Lỗi'.$e->getMessage());
        }
    }

    public function delete($id, $grade, $idTS){
        try{
            $idStudent = $id;
            $idGradeStudent = $grade;
            $gpaSubject = $this->gpaSubject->find($idTS);
            $idSemesterDelete = $gpaSubject->id_semester;
            $idSchoolYearDelete = $gpaSubject->id_school_year;
            if($idSemesterDelete == 1){
                $checkGPASubject = $this->gpaSchoolYear->where('id_student',$id)->where('id_grade',$grade)->first();
                if($checkGPASubject->gpa_semester_2 == null){
                    $checkGPASubject->delete();
                }
                else{
                    $checkGPASubject->update([
                        'gpa_semester_1' => null,
                        'gpa_school_year' => null,
                    ]);
                }

            }
            else if($idSemesterDelete == 2){
                $checkGPASubject = $this->gpaSchoolYear->where('id_student',$id)->where('id_grade',$grade)->first();
                if($checkGPASubject->gpa_semester_1 == null){
                    $checkGPASubject->delete();
                }
                else{
                     $checkGPASubject->update([
                    'gpa_semester_2' => null,
                    'gpa_school_year' => null,
                ]);
                }
                
            }
            $gpaSubject->delete();
            return redirect()->route('student.transcript',['id'=>$idStudent,'grade'=>$idGradeStudent]);
        }catch(\Exception $e){
            Log::error('Message:'.$e->getMessage());
        }
    }
}
